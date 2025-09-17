<?php

namespace App\Services;

use App\Models\Task;

class DiscordTaskFormatter
{
    /**
     * Format a single Task into the structure Node.js expects.
     */
    public static function format(Task $task): array
    {
        $meta = json_decode($task->meta, true) ?? [];

        $formatted = [
            '_comment' => $task->action . ' task',
            // node id
            'id'       => $task->action . '_' . $task->id,
            // Real Laravel DB id
            'task_id'  => $task->id,
            'type'     => $task->action,
            'reward'   => $task->reward,
        ];

        switch ($task->action) {
            case 'message':
                $formatted['channelId'] = $meta['channelId'] ?? null;
                $formatted['match']     = $meta['match'] ?? null;
                break;

            case 'reaction':
                $formatted['messageId'] = $meta['messageId'] ?? null;
                $formatted['emoji']     = $meta['emoji'] ?? null;
                break;

            case 'role':
                $formatted['roleId'] = $meta['roleId'] ?? null;
                break;

            case 'attachment':
                $formatted['channelId'] = $meta['channelId'] ?? null;
                break;

            case 'reply':
                $formatted['parentMessageId'] = $meta['parentMessageId'] ?? null;
                break;

            case 'thread':
                $formatted['threadId'] = $meta['threadId'] ?? null;
                break;

            case 'mention':
                $formatted['channelId'] = $meta['channelId'] ?? null;
                break;

            case 'live_event':
                $formatted['channelId'] = $meta['channelId'] ?? null;
                break;
        }

        return array_filter($formatted, fn($v) => !is_null($v));
    }

    /**
     * Format a collection of Tasks.
     */
    public static function formatCollection($tasks)
    {
        return $tasks->map(fn($task) => self::format($task))->values();
    }
}
