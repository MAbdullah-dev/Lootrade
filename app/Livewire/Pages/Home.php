<?php

namespace App\Livewire\Pages;

use App\Jobs\GenerateTicketsJob;
use App\Models\Raffle;
use App\Models\Task;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Home extends Component
{
    public $tasks;
    public $showRewardModal = false;
    public $earnedReward = 0;

    public function mount()
    {
        $this->fetchTasks();
    }

    public function fetchTasks()
    {
        $this->tasks = Task::where('is_active', true)->get();
    }

    #[On('completeTask')]
    public function rewardUser($taskId)
    {
        $user = Auth::user();
        Log::info("User {$user->id} is attempting to complete Task {$taskId}");

        if ($user->completedTasks->contains($taskId)) {
            return;
        }

        $task = Task::findOrFail($taskId);
        Log::info("Task found: {$task->platform} for user {$user->id}");

        $user->completedTasks()->attach($task->id, [
            'completed_at' => now()
        ]);

        GenerateTicketsJob::dispatch(
            $user->id,
            $task->reward,
            acquisitionType: 'earned'
        );
        // 🔥 Dispatch Livewire event to update ticket count in Header
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
