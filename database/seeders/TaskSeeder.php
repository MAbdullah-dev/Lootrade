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
                'link'       => 'https://discord.gg/yBPMajRj3y',
                'meta'       => json_encode([
                    'guild_id' => '1399726973202202757',
                    'invite_link' => 'https://discord.gg/yBPMajRj3y'
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
                'link'       => 'https://www.youtube.com/watch?v=VQWCPdmhY8I',
                'meta'       => json_encode([
                    'video_id' => 'VQWCPdmhY8I',
                    'duration' => 60,
                ]),
                'reward'     => 5,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'lootraiders',
                'platform'   => 'x',
                'action'     => 'follow_user',
                'link'       => 'https://x.com/ElementsofaSoul',
                'meta'       => json_encode([
                    'username' => 'ElementsofaSoul',
                    "target_user_id" => "1775079366243794944"
                ]),
                'reward'     => 8,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'lootraiders',
                'platform'   => 'x',
                'action'     => 'like_tweet',
                'link'       => 'https://x.com/ElementsofaSoul/status/1868963256809013474',
                'meta'       => json_encode([
                    'tweet_id' => '1868963256809013474',
                    'author'   => 'ElementsofaSoul'
                ]),
                'reward'     => 5,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'lootraiders',
                'platform'   => 'x',
                'action'     => 'repost_tweet',
                'link'       => 'https://x.com/ElementsofaSoul/status/1868963256809013474',
                'meta'       => json_encode([
                    'tweet_id' => '1868963256809013474',
                    'username' => 'ElementsofaSoul',
                ]),
                'reward'     => 8,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'lootraiders',
                'platform'   => 'youtube',
                'action'     => 'like_video',
                'link'       => 'https://www.youtube.com/watch?v=1ZsjaURJgzc',
                'meta'       => json_encode([
                    'video_id' => '1ZsjaURJgzc',
                ]),
                'reward'     => 5,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
