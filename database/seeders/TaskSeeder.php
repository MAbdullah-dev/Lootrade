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
                'username' => 'username',
                'platform' => 'instagram',
                'action' => 'visit',
                'link' => 'https://instagram.com/',
                'reward' => 10,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'x',
                'action' => 'join',
                'link' => 'https://x.com/',
                'reward' => 15,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'youtube',
                'action' => 'subscribe',
                'link' => 'https://www.youtube.com/',
                'reward' => 20,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'discord',
                'action' => 'visit',
                'link' => 'https://discord.com',
                'reward' => 5,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'kick',
                'action' => 'visit',
                'link' => 'https://kick.com',
                'reward' => 5,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'telegram',
                'action' => 'join',
                'link' => 'https://t.me/',
                'reward' => 10,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'facebook',
                'action' => 'like',
                'link' => 'https://facebook.com/',
                'reward' => 8,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'tiktok',
                'action' => 'follow',
                'link' => 'https://tiktok.com/@username',
                'reward' => 12,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'reddit',
                'action' => 'visit',
                'link' => 'https://reddit.com/u/username',
                'reward' => 9,
                'is_active' => true,
            ],
            [
                'username' => 'username',
                'platform' => 'linkedin',
                'action' => 'connect',
                'link' => 'https://linkedin.com/in/username',
                'reward' => 11,
                'is_active' => true,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
