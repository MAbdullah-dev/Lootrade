<?php

namespace App\Livewire\Pages;

use App\Jobs\GenerateTicketsJob;
use App\Models\Raffle;
use App\Models\Task;
use App\Services\TaskVerificationService;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
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

        $social = match ($type) {
            'discord:join_server' => $user->socialAccounts()->where('provider', 'discord')->first(),
            'youtube:like_video',  => $user->socialAccounts()->where('provider', 'google')->first(),
            'x:like_tweet' => $user->socialAccounts()->where('provider', 'twitter')->first(),
            'x:follow_user' => $user->socialAccounts()->where('provider', 'twitter')->first(),
            'x:repost_tweet' => $user->socialAccounts()->where('provider', 'twitter')->first(),
            'youtube:watch_timer' => true,
            default => true,
        };

        if (!$social) {
            alert_error("Please connect your {$task->platform} account first.");
            return;
        }

        $taskId = json_encode($taskId);
        $url = json_encode($task->link);
        $meta = json_encode(json_decode($task->meta ?? '[]'));

        $this->js(<<<JS
    window.dispatchEvent(new CustomEvent('task-access-granted', {
        detail: {
            taskId: {$taskId},
            url: {$url},
            meta: {$meta}
        }
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
