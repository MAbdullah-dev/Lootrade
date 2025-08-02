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
                'username'   => 'lootraiders',
                'platform'   => 'discord',
                'action'     => 'join_server',
                'link'       => 'https://discord.gg/KZjWU4ub',
                'meta'       => json_encode([
                    'guild_id' => '1399726973202202757',
                    'invite_link' => 'https://discord.gg/KZjWU4ub'
                ]),
                'reward'     => 10,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'lootraiders',
                'platform'   => 'youtube',
                'action'     => 'watch_video',
                'link'       => 'https://www.youtube.com/watch?v=D0UnqGm_miA',
                'meta'       => json_encode([
                    'video_id' => 'D0UnqGm_miA',
                    'duration' => 12,
                ]),
                'reward'     => 5,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'username'   => 'lootraiders',
            //     'platform'   => 'youtube',
            //     'action'     => 'like_video',
            //     'link'       => 'https://www.youtube.com/watch?v=1ZsjaURJgzc',
            //     'meta'       => json_encode([
            //         'video_id' => '1ZsjaURJgzc',
            //         'duration' => 60,
            //     ]),
            //     'reward'     => 5,
            //     'is_active'  => true,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
