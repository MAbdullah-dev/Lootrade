<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'username'  => 'lootraiders',
                'platform'  => 'discord',
                'action'    => 'join_server',
                'link'      => 'https://discord.gg/yBPMajRj3y',
                'meta'      => json_encode([
                    'guildId' => '1399726973202202757',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'username'  => 'Elements of a Soul',
                'platform'  => 'youtube',
                'action'    => 'watch_video',
                'link'      => 'https://www.youtube.com/watch?v=VQWCPdmhY8I',
                'meta'      => json_encode([
                    'duration' => 59,
                    'videoId'  => 'VQWCPdmhY8I',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'username'  => 'Elements of a soul',
                'platform'  => 'x',
                'action'    => 'follow_user',
                'link'      => 'https://x.com/ElementsofaSoul',
                'meta'      => json_encode([
                    'targetUserId' => '1775079366243794944',
                    'username'     => 'ElementsofaSoul',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'username'  => 'Elements of a soul',
                'platform'  => 'x',
                'action'    => 'like_tweet',
                'link'      => 'https://x.com/ElementsofaSoul/status/1868963256809013474',
                'meta'      => json_encode([
                    'tweetId' => '1868963256809013474',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'username'  => 'Elements of a Soul',
                'platform'  => 'x',
                'action'    => 'repost_tweet',
                'link'      => 'https://x.com/ElementsofaSoul/status/1868963256809013474',
                'meta'      => json_encode([
                    'tweetId' => '1868963256809013474',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
