<?php

namespace App\Livewire\Pages;

use App\Jobs\GenerateTicketsJob;
use App\Models\Raffle;
use App\Models\Task;
use App\Services\TaskVerificationService;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Home extends Component
{
    public $normalTasks = [];
    public $discordNativeTasks = [];
    public $hasDiscordNativeTasks = false;
    public $hasJoinedServer = false;
    public $tasks;
    public $showRewardModal = false;
    public $earnedReward = 0;
    public $showYouTubeHandleModal = false;
    public $youtubeHandle = '';
    public $currentTaskId = null;

    public TaskVerificationService $taskVerifier;

    public function mount()
    {
        $this->fetchTasks();
    }

    public function fetchTasks()
    {
        $user = Auth::user();

        $allTasks = Task::where('is_active', true)->get();

        $this->hasJoinedServer = $user->completedTasks()
            ->where('platform', 'discord')
            ->where('action', 'join_server')
            ->exists();

        $this->normalTasks = $allTasks->filter(fn($t) => $t->platform !== 'discord_native');
        $this->discordNativeTasks = $allTasks->filter(fn($t) => $t->platform === 'discord_native');
        // dd($this->discordNativeTasks);
        $this->hasDiscordNativeTasks = $this->discordNativeTasks->isNotEmpty();
    }

    #[On('checkTaskAccess')]
    public function checkTaskAccess($taskId)
    {
        $user = Auth::user();
        $task = Task::findOrFail($taskId);

        $type = "{$task->platform}:{$task->action}";

        // Get connected social account
        $social = match ($type) {
            'discord:join_server' => $user->socialAccounts()->where('provider', 'discord')->first(),
            'youtube:comment_video' => $user->socialAccounts()->where('provider', 'google')->first(),
            'x:like_tweet', 'x:follow_user', 'x:repost_tweet' => $user->socialAccounts()->where('provider', 'twitter')->first(),
            'youtube:watch_video' => true,
            default => true,
        };

        if (!$social) {
            $provider = match ($task->platform) {
                'x' => 'twitter',
                default => $task->platform,
            };
            alert_error("Please connect your {$task->platform} account first.", 2000);
            $this->dispatch('redirectAfterDelay', [
                'url' => route('auth.redirect', ['provider' => $task->platform]),
                'delay' => 2000,
            ]);
            return;
        }

        // --- Check YouTube channel ID ---
        if ($task->platform === 'youtube' && $task->action === 'comment_video') {
            if (!$social->youtube_channel_id) {
                // Store current task to open modal after saving handle
                $this->currentTaskId = $taskId;
                $this->showYouTubeHandleModal = true;
                $this->dispatch('open-youtube-handle-modal', [
                    'taskId' => $taskId,
                ]);
                return;
            }
        }

        // Grant task access if all checks pass
        $taskIdJson = json_encode($taskId);
        $url = json_encode($task->link);
        $meta = json_encode(json_decode($task->meta ?? '[]'));

        $this->js(<<<JS
        window.dispatchEvent(new CustomEvent('task-access-granted', {
            detail: { taskId: {$taskIdJson}, url: {$url}, meta: {$meta} }
        }));
JS);
    }



    #[On('completeTask')]
    public function rewardUser($taskId)
    {
        $user = Auth::user();
        $task = Task::findOrFail($taskId);

        if ($user->completedTasks->contains($task->id)) {
            return;
        }

        $verifier = app(TaskVerificationService::class);

        if (!$verifier->verify($task, $user)) {
            Log::warning("Task verification failed for user {$user->id}, task {$task->id}");
            alert_error('Verification failed');
            return;
        }

        $user->completedTasks()->attach($task->id, ['completed_at' => now()]);
        GenerateTicketsJob::dispatch($user->id, $task->reward, acquisitionType: 'earned');

        $user->update(['ticket_balance' => $user->ticket_balance + $task->reward]);
        $this->dispatch('ticket-balance-updated');
        $this->earnedReward = $task->reward;
        $this->showRewardModal = true;
        $this->fetchTasks();
    }

    public function saveYouTubeHandle()
    {
        $this->validate([
            'youtubeHandle' => ['required', 'string', 'max:100'],
        ]);

        $user = Auth::user();
        $rawInput = trim($this->youtubeHandle);
        Log::info("YouTube handle entered: {$rawInput}");

        // Extract handle from input: either @handle or full URL
        $handle = null;
        if (preg_match('/(?:youtube\.com\/)?@([\w\.\-]+)/i', $rawInput, $matches)) {
            $handle = $matches[1];
        }


        if (!$handle) {
            alert_error("Could not extract a valid YouTube handle from '{$rawInput}'. Please enter a valid @handle or channel URL.");
            return;
        }

        Log::info("Normalized handle: {$handle}");

        try {
            $apiKey = env('YOUTUBE_API_KEY');

            $channelResponse = Http::get("https://www.googleapis.com/youtube/v3/channels", [
                'part' => 'id',
                'forHandle' => "@{$handle}",
                'key' => $apiKey,
            ]);

            Log::info("YouTube Channels API response: " . $channelResponse->body());

            if ($channelResponse->failed()) {
                alert_error("Failed to fetch YouTube channel info. Please check your connection or try again later.");
                return;
            }

            $channelData = $channelResponse->json();
            $items = $channelData['items'] ?? [];

            if (count($items) === 0) {
                alert_error("This handle could not be resolved. It is possible that this Google account does not have a YouTube channel yet. Please create a YouTube channel first and try again.");
                return;
            }

            $channelId = $items[0]['id'];

            $googleAccount = $user->socialAccounts()->where('provider', 'google')->first();
            $googleAccount->youtube_channel_id = $channelId;
            $googleAccount->save();

            $this->showYouTubeHandleModal = false;
            $this->youtubeHandle = '';

            if ($this->currentTaskId) {
                $this->checkTaskAccess($this->currentTaskId);
                $this->currentTaskId = null;
            }

            alert_success("YouTube channel connected successfully!");
        } catch (\Exception $e) {
            Log::error("Error saving YouTube channel: " . $e->getMessage());

            alert_error("An unexpected error occurred. Please try again.");
        }
    }



    public function closeRewardModal()
    {
        $this->showRewardModal = false;
    }

    public function render()
    {
        $now = now();

        return view('livewire.pages.home', [
            'activeRaffles' => Raffle::where('start_date', '<=', $now)
                ->where('end_date', '>=', $now)
                ->latest()
                ->paginate(3),

            'upcomingRaffles' => Raffle::where('start_date', '>', $now)
                ->latest()
                ->paginate(3),

            'pastRaffles' => Raffle::where('end_date', '<', $now)
                ->latest()
                ->paginate(3),
        ]);
    }
}
