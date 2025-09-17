<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateTicketsJob;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\UserSocialAccount;
use App\Services\DiscordTaskFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DiscordNativeTaskController extends Controller
{
    public function index(Request $request)
    {
        $apiKey = $request->header('X-Bot-API-Key');
        if ($apiKey !== env('DISCORD_BOT_TASKS_API_KEY')) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $tasks = DiscordTaskFormatter::formatCollection(
            Task::where('platform', 'discord_native')
                ->where('is_active', true)
                ->get(['id', 'action', 'meta', 'reward'])
        );

        return response()->json($tasks);
    }

    public function store(Request $request)
    {

        Log::info('DiscordNativeTaskController@store hit', [
            'time' => now()->toDateTimeString(),
            'ip'   => $request->ip(),
            'headers' => $request->headers->all(),
        ]);

        $signature = $request->header('X-Bot-Signature');
        $payload   = $request->getContent();
        $expected  = hash_hmac('sha256', $payload, env('BOT_SECRET'));

        if (!hash_equals($expected, $signature)) {
            return response()->json(['success' => false, 'error' => 'Invalid signature', 'code' => 'INVALID_SIGNATURE'], 401);
        }

        Log::info('Signature debug', [
            'raw_payload'     => $payload,
            'decoded_payload' => json_decode($payload, true),
            'signature_sent'  => $signature,
            'expected'        => $expected,
            'match'           => hash_equals($expected, (string)$signature),
            'bot_secret'      => substr(env('BOT_SECRET'), 0, 6) . '...',
        ]);

        $data = json_decode($payload, true);

        Log::info('Verified Discord bot payload', $data);

        $taskId    = $data['task']['task_id'] ?? null;
        $discordId = $data['task']['user']['id'] ?? null;

        if (!$taskId || !$discordId) {
            return response()->json(['success' => false, 'error' => 'Invalid payload', 'code' => 'INVALID_PAYLOAD'], 422);
        }

        $social = UserSocialAccount::where('provider', 'discord')
            ->where('provider_id', $discordId)
            ->first();

        if (!$social) {
            return response()->json(['success' => false, 'error' => 'User not linked', 'code' => 'USER_NOT_LINKED'], 404);
        }

        $user = $social->user;

        $task = Task::find($taskId);
        if (!$task) {
            return response()->json(['success' => false, 'error' => 'Task not found', 'code' => 'TASK_NOT_FOUND'], 404);
        }


        try {
            $alreadyCompleted = false;

            DB::transaction(function () use ($user, $task, $taskId, &$alreadyCompleted) {
                if ($user->completedTasks()->where('task_id', $taskId)->exists()) {
                    $alreadyCompleted = true;
                    return;
                }

                $user->completedTasks()->attach($taskId, ['completed_at' => now()]);

                $user->increment('ticket_balance', $task->reward);

                GenerateTicketsJob::dispatch($user->id, $task->reward);

                $ticketWord = Str::plural('ticket', $task->reward);

                Notification::create([
                    'user_id' => $user->id,
                    'type'    => 'task_completed',
                    'message' => "You completed a Discord task and earned {$task->reward} {$ticketWord}!",
                ]);
            });

            if ($alreadyCompleted) {
                return response()->json([
                    'success' => false,
                    'error'   => 'Task already completed',
                    'code'    => 'ALREADY_COMPLETED',
                ], 200);
            }
        } catch (\Exception $e) {
            Log::error("Task reward error", ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'error'   => 'Server error',
                'code'    => 'SERVER_ERROR',
            ], 500);
        }

        return response()->json([
            'success'     => true,
            'code'        => 'REWARDED',
            'user_id'     => $user->id,
            'task_id'     => $taskId,
            'new_balance' => $user->fresh()->ticket_balance,
            'reward'      => $task->reward,
        ]);
    }
}
