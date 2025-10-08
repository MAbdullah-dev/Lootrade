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
        $url = config('services.node_api_url');
        if (!$url) return;

        $tasks = Task::where('platform', 'discord_native')
            ->where('is_active', true)
            ->get();

        $payload = DiscordTaskFormatter::formatCollection($tasks)->toArray();

        try {
            Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.discord_bot_tasks_api_key'),
            ])->timeout(2)
                ->post($url . '/update-tasks', $payload);

            Log::info('Discord tasks synced', ['count' => count($payload)]);
        } catch (\Throwable $e) {
            Log::error('Discord sync failed: ' . $e->getMessage());
        }
    }
}
