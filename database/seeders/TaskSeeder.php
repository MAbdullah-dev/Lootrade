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
                'platform'  => 'youtube',
                'action'    => 'like_video',
                'link'      => 'https://www.youtube.com/watch?v=VQWCPdmhY8I',
                'meta'      => json_encode([
                    'videoId' => 'VQWCPdmhY8I',
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
            [
                'platform'  => 'discord_native',
                'action'    => 'message',
                'meta'      => json_encode([
                    'description' => 'Go to #raffle and message raffleentry',
                    'channelId'   => '1412604916140216361',
                    'match'       => 'raffleentry',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'platform'  => 'discord_native',
                'action'    => 'reaction',
                'meta'      => json_encode([
                    'description' => 'Go the #raffle and react 👍 to the pinned message',
                    'messageId'   => '1417760247958994984',
                    'emoji'       => '👍',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'platform'  => 'discord_native',
                'action'    => 'role',
                'meta'      => json_encode([
                    'description' => 'Get #OG role',
                    'roleId'      => '1412799811618340965',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'platform'  => 'discord_native',
                'action'    => 'attachment',
                'meta'      => json_encode([
                    'channelId'   => '1412604916140216361',
                    'description' => 'Send Attachments in #raffle',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'platform'  => 'discord_native',
                'action'    => 'reply',
                'meta'      => json_encode([
                    'parentMessageId' => '1417764189388275722',
                    'description'     => 'Go to #raffle and reply to our reply message',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'platform'  => 'discord_native',
                'action'    => 'thread',
                'meta'      => json_encode([
                    'description' => 'Go to #raffle and participate in our thread',
                    'threadId'    => '1417764861646999603',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'platform'  => 'discord_native',
                'action'    => 'mention',
                'meta'      => json_encode([
                    'description' => 'Go to #raffle and mention @lootraiders bot',
                    'channelId'   => '1412604916140216361',
                ]),
                'reward'    => 1,
                'is_active' => 1,
            ],
            [
                'platform'  => 'discord_native',
                'action'    => 'live_event',
                'meta'      => json_encode([
                    'description' => 'Go to #raffle, send a message b/w lifestream',
                    'channelId'   => '1412604916140216361',
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
