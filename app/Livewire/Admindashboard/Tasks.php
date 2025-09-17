<?php

namespace App\Livewire\Admindashboard;

use App\Models\Task;
use Livewire\Component;

class Tasks extends Component
{
    public $tasks;
    public $platform, $action, $reward, $link, $username;
    public $meta = [];
    public $showModal = false;

    public function rules()
    {
        $rules = [
            'platform' => 'required|string',
            'action'   => 'required|string',
            'reward'   => 'required|integer|min:1',
        ];

        // Discord
        if ($this->platform === 'discord' && $this->action === 'join_server') {
            $rules['username'] = 'required|string';
            $rules['link'] = 'required|url';
            $rules['meta.guildId'] = 'required|string';
            // $rules['meta.inviteLink'] = 'required|url';
        }

        // YouTube
        if ($this->platform === 'youtube') {
            $rules['username'] = 'required|string';
            $rules['link'] = 'required|url';

            if ($this->action === 'watch_video') {
                $rules['meta.videoId'] = 'required|string';
                $rules['meta.duration'] = 'required|integer|min:1';
            }

            if ($this->action === 'like_video') {
                $rules['meta.videoId'] = 'required|string';
            }
        }

        // X (Twitter)
        if ($this->platform === 'x') {
            $rules['username'] = 'required|string';
            $rules['link'] = 'required|url';

            if ($this->action === 'follow_user') {
                $rules['meta.username'] = 'required|string';
                $rules['meta.targetUserId'] = 'required|string';
            }

            if ($this->action === 'like_tweet' || $this->action === 'repost_tweet') {
                $rules['meta.tweetId'] = 'required|string';
            }
        }

        // Discord Native
        if ($this->platform === 'discord_native') {
            $rules['meta.description'] = 'required|string|max:255';
            switch ($this->action) {
                case 'message':
                    $rules['meta.channelId'] = 'required|string';
                    $rules['meta.match'] = 'required|string';
                    break;
                case 'reaction':
                    $rules['meta.messageId'] = 'required|string';
                    $rules['meta.emoji'] = 'required|string';
                    break;
                case 'role':
                    $rules['meta.roleId'] = 'required|string';
                    break;
                case 'attachment':
                    $rules['meta.channelId'] = 'required|string';
                    break;
                case 'reply':
                    $rules['meta.parentMessageId'] = 'required|string';
                    break;
                case 'thread':
                    $rules['meta.threadId'] = 'required|string';
                    break;
                case 'mention':
                    $rules['meta.channelId'] = 'required|string';
                    break;
                case 'live_event':
                    $rules['meta.channelId'] = 'required|string';
                    break;
            }
        }

        return $rules;
    }

    public function mount()
    {
        $this->tasks = Task::latest()->get();
    }

    public function openModal()
    {
        $this->reset(['platform', 'action', 'reward', 'link', 'meta', 'username']);
        $this->showModal = true;
    }

    public function toggleActive($id)
    {
        $task = Task::findOrFail($id);
        $task->is_active = !$task->is_active;
        $task->save();

        // refresh UI immediately
        $this->tasks = Task::latest()->get();

        if ($task->platform === 'discord_native') {
            $this->syncDiscordNativeTasks();
        }
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $platform = $task->platform;

        $task->delete();
        $this->tasks = Task::latest()->get();

        if ($platform === 'discord_native') {
            $this->syncDiscordNativeTasks();
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->platform === 'youtube' && $this->action === 'watch_video' && isset($this->meta['duration'])) {
        $this->meta['duration'] = max(1, $this->meta['duration'] - 2); 
    }


        $task = Task::create([
            'username'  => $this->username,
            'platform'  => $this->platform,
            'action'    => $this->action,
            'link'      => $this->link,
            'meta'      => json_encode($this->meta),
            'reward'    => $this->reward,
            'is_active' => true,
        ]);

        $this->tasks = Task::latest()->get();
        $this->showModal = false;

        if ($task->platform === 'discord_native') {
            $this->syncDiscordNativeTasks();
        }
    }

    protected function syncDiscordNativeTasks()
    {
        \App\Jobs\SyncDiscordTasksJob::dispatch()->afterResponse();
    }

    public function render()
    {
        return view('livewire.admindashboard.tasks', [
            'tasks' => Task::latest()->get(),
        ])->layout('components.layouts.Admindashboard');
    }
}
