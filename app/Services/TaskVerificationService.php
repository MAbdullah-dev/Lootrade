<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TaskVerificationService
{
    public function verify(Task $task, User $user): bool
    {
        $type = "{$task->platform}:{$task->action}";

        return match ($type) {
            'discord:join_server' => $this->verifyDiscordJoin($task, $user),
            'youtube:watch_timer' => $this->verifyTimerOnly($task, $user),
            'youtube:like_video' => $this->verifyYouTubeLike($task, $user),
            default => true,
        };
    }

    private function verifyDiscordJoin(Task $task, User $user): bool
    {
        Log::info("verifyDiscordJoin() called for user {$user->id}, task {$task->id}");

        $social = $user->socialAccounts()->where('provider', 'discord')->first();
        if (!$social) {
            Log::warning("No Discord social account found for user {$user->id}");
            return false;
        }

        Log::info("Found Discord social account: provider_id = {$social->provider_id}");

        $meta = is_string($task->meta) ? json_decode($task->meta, true) : $task->meta;
        $guildId = $meta['guild_id'] ?? null;

        if (!$guildId) {
            Log::warning("No guild_id found in task meta for task {$task->id}");
            return false;
        }

        Log::info("Attempting to check guild member: guild_id = $guildId");

        try {
            $url = "https://discord.com/api/v10/guilds/{$guildId}/members/{$social->provider_id}";
            $botToken = "Bot " . config('services.discord.bot_token');

            Log::info("Making Discord API request to: $url");

            $response = Http::withHeaders([
                'Authorization' => $botToken,
                'User-Agent' => 'DiscordBot (https://yourapp.example, v1.0)',
            ])->get($url);

            Log::info("Discord API Response status: " . $response->status());
            Log::info("Discord API Response body: " . $response->body());

            return $response->ok();
        } catch (\Exception $e) {
            Log::error("Discord verification failed: " . $e->getMessage());
            return false;
        }
    }

    private function verifyTimerOnly(Task $task, User $user): bool
    {
        return true;
    }

    private function verifyYouTubeLike(Task $task, User $user): bool
{
    Log::info("verifyYouTubeLike() called for user {$user->id}, task {$task->id}");

    $social = $user->socialAccounts()->where('provider', 'google')->first();

    if (!$social || !$social->access_token) {
        Log::warning("No Google social account or access token found for user {$user->id}");
        return false;
    }

    $meta = is_string($task->meta) ? json_decode($task->meta, true) : $task->meta;
    $videoId = $meta['video_id'] ?? null;

    if (!$videoId) {
        Log::warning("No video_id found in task meta for task {$task->id}");
        return false;
    }

    try {
        $url = "https://www.googleapis.com/youtube/v3/videos";
        $response = Http::withToken($social->access_token)
            ->get($url, [
                'part' => 'id',
                'myRating' => 'like',
                'maxResults' => 50
            ]);

        Log::info("YouTube API Response: " . $response->body());

        if (!$response->ok()) {
            Log::warning("YouTube API call failed");
            return false;
        }

        $likedVideos = $response->json('items') ?? [];
        foreach ($likedVideos as $video) {
            if (($video['id'] ?? null) === $videoId) {
                Log::info("Video $videoId found in liked videos.");
                return true;
            }
        }

        Log::info("Video $videoId not found in liked videos.");
        return false;

    } catch (\Exception $e) {
        Log::error("YouTube like verification failed: " . $e->getMessage());
        return false;
    }
}


}
