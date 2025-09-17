<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\DiscordTaskFormatter;

class SyncDiscordTasksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $url = env('NODE_API_URL');
        if (!$url) return;

        // Fetch all active Discord Native tasks
        $tasks = Task::where('platform', 'discord_native')
            ->where('is_active', true)
            ->get();

        $payload = DiscordTaskFormatter::formatCollection($tasks)->toArray();

        try {
            Http::withHeaders([
                'Authorization' => 'Bearer ' . env('DISCORD_BOT_TASKS_API_KEY'),
            ])->timeout(2)
              ->post($url . '/update-tasks', $payload);

            Log::info('Discord tasks synced', ['count' => count($payload)]);
        } catch (\Throwable $e) {
            Log::error('Discord sync failed: ' . $e->getMessage());
        }
    }
}
