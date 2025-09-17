<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
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
            'x:follow_user'       => $this->verifyXFollow($task, $user),
            'x:repost_tweet'       => $this->verifyXRepost($task, $user),
            'x:like_tweet'        => $this->verifyXLike($task, $user),
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
        $guildId = $meta['guildId'] ?? null;

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
        $videoId = $meta['videoId'] ?? null;

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

    private function verifyXLike(Task $task, User $user): bool
    {
        $social = $user->socialAccounts()->where('provider', 'twitter')->first();
        if (!$social || !$social->access_token) {
            return false;
        }

        $meta = json_decode($task->meta, true);
        $tweetId = $meta['tweetId'] ?? null;

        if (!$tweetId) return false;

        try {
            $url = "https://api.x.com/2/users/{$social->provider_id}/liked_tweets?max_results=100";

            $response = Http::withToken($social->access_token)
                ->withHeaders(['Accept' => 'application/json'])
                ->get($url);

            if (!$response->ok()) return false;

            return collect($response->json('data') ?? [])
                ->contains(fn($tweet) => $tweet['id'] === $tweetId);
        } catch (\Exception $e) {
            Log::error("X like verification failed: " . $e->getMessage());
            return false;
        }
    }

    private function verifyXFollow(Task $task, User $user): bool
    {
        $social = $user->socialAccounts()->where('provider', 'twitter')->first();

        if (!$social || !$social->access_token) {
            Log::warning("No X account or token for user {$user->id}");
            return false;
        }

        $meta = is_string($task->meta) ? json_decode($task->meta, true) : $task->meta;
        $targetUserId = $meta['targetUserId'] ?? null;

        if (!$targetUserId) {
            Log::warning("No target user id in task {$task->id}");
            return false;
        }

        $token = $social->access_token;
        $url = "https://api.x.com/2/users/{$social->provider_id}/following";

        try {
            $postResponse = Http::withToken($token)
                ->withHeaders(['Accept' => 'application/json'])
                ->post($url, ['target_user_id' => $targetUserId]);

            $following = false;

            if ($postResponse->ok()) {
                $data = $postResponse->json();
                $following = $data['data']['following'] ?? false;
                $pendingFollow = $data['data']['pending_follow'] ?? false;

                Log::info("Temporary follow response for user {$user->id}", [
                    'following' => $following,
                    'pending' => $pendingFollow,
                ]);

                if ($following && !$pendingFollow) {
                    $deleteUrl = "https://api.x.com/2/users/{$social->provider_id}/following?target_user_id={$targetUserId}";

                    Http::withToken($token)
                        ->withHeaders(['Accept' => 'application/json'])
                        ->delete($deleteUrl);
                }
            } else {
                Log::error("Temporary follow request failed", [
                    'status' => $postResponse->status(),
                    'body' => $postResponse->body(),
                ]);
            }

            return $following;
        } catch (\Exception $e) {
            Log::error("X follow verification exception for user {$user->id}: {$e->getMessage()}", [
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    private function verifyXRepost(Task $task, User $user): bool
    {
        $social = $user->socialAccounts()->where('provider', 'twitter')->first();
        if (!$social || !$social->access_token) {
            return false;
        }

        $meta = json_decode($task->meta, true);
        $tweetId = $meta['tweetId'] ?? null;

        if (!$tweetId) return false;

        try {
            $url = "https://api.x.com/2/tweets/{$tweetId}/retweeted_by";

            $response = Http::withToken($social->access_token)->get($url);

            if (!$response->ok()) {
                Log::error("X repost verification failed: " . $response->body());
                return false;
            }

            foreach ($response->json('data') ?? [] as $account) {
                if ($account['id'] === $social->provider_id) {
                    return true;
                }
            }

            return false;
        } catch (\Exception $e) {
            Log::error("X repost verification exception: " . $e->getMessage());
            return false;
        }
    }
}
