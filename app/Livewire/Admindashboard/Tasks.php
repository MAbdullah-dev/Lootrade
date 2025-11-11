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

            // Watch Video
            if ($this->action === 'watch_video') {
                $rules['meta.videoId'] = 'required|string';
                $rules['meta.duration'] = 'required|integer|min:1';
            }

            // Comment on a Specific Video
            if ($this->action === 'comment_video') {
                $rules['meta.videoId'] = 'required|string';
                $rules['meta.phrase']  = 'required|string';
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

    public function messages()
    {
        return [
            'platform.required' => 'Please select a platform.',
            'action.required'   => 'Please select an action.',
            'reward.required'   => 'Reward is required.',
            'reward.min'        => 'Reward must be at least 1.',

            // Discord
            'meta.guildId.required' => 'Please provide the Discord server ID.',

            // YouTube
            'meta.videoId.required'   => 'Please enter the YouTube video ID.',
            'meta.duration.required'  => 'Please enter the minimum watch duration.',
            'meta.duration.min'       => 'Duration must be at least 1 second.',
            'meta.phrase.required'    => 'Please provide a unique phrase or code.',
            'meta.commentId.required' => 'Please provide the comment ID to reply to.',
            'meta.channelId.required' => 'Please enter the YouTube channel ID.',
            'meta.code.required'      => 'Please enter the unique code for playlist verification.',
            'meta.streamId.required'  => 'Please enter the live stream video ID.',

            // X (Twitter)
            'meta.username.required'     => 'Please provide the target username.',
            'meta.targetUserId.required' => 'Please provide the user ID to follow.',
            'meta.tweetId.required'      => 'Please provide the tweet ID.',

            // Discord Native
            'meta.description.required' => 'Please add a short description for this task.',
            'meta.channelId.required'   => 'Please enter the Discord channel ID.',
            'meta.match.required'       => 'Please specify the message content to match.',
            'meta.messageId.required'   => 'Please provide the message ID.',
            'meta.emoji.required'       => 'Please specify the emoji for this reaction.',
            'meta.roleId.required'      => 'Please provide the Discord role ID.',
            'meta.parentMessageId.required' => 'Please provide the parent message ID.',
            'meta.threadId.required'    => 'Please provide the thread ID.',
        ];
    }


    public function mount()
    {
        $this->tasks = Task::latest()->get();
    }


    public function updated($propertyName)
    {
        $this->resetErrorBag();
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
