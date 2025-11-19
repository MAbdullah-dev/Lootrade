<div class="task-card d-flex justify-content-between align-items-center">
        <div class="d-flex flex-column gap-1">
        <div class="d-flex align-items-center gap-2">
            {!! getPlatformIcon($task->platform) !!}
            @if($task->platform === 'discord_native')
                @php $meta = json_decode($task->meta, true); @endphp
                <span class="task-desc text-secondary">{{ $meta['description'] ?? 'No description available' }}</span>
            @else
                <span class="tasks-username">{{ $task->username }}</span>
            @endif
        </div>

        @if($task->platform === 'youtube' && $task->action === 'comment_video')
            @php $meta = json_decode($task->meta, true); @endphp
            @if(!empty($meta['phrase']))
                <small class="text-secondary">Comment this: "{{ $meta['phrase'] }}"</small>
            @endif
        @endif
    </div>

    <div class="d-flex align-items-center gap-2">
        @php
            $user = auth()->user();
            $isCompleted = $user->completedTasks->contains($task->id);
        @endphp

        @if($task->platform === 'discord_native')
            <a
                href="https://discord.com/channels/1238395623720357889"
                target="_blank"
                class="task-action {{ $isCompleted ? 'opacity-50 cursor-not-allowed' : '' }}"
                onclick="{{ $isCompleted ? 'return false;' : "openTask({$task->id}, '')" }}">
                {{ $isCompleted ? 'Completed' : ucfirst($task->action) }}
            </a>
        @else
            <a
                href="#"
                data-id="{{ $task->id }}"
                class="task-action {{ $isCompleted ? 'opacity-50 cursor-not-allowed' : '' }}"
                onclick="{{ $isCompleted ? 'return false;' : "openTask({$task->id}, '{$task->link}')" }}">
                {{ $isCompleted ? 'Completed' : ucfirst($task->action) }}
            </a>
        @endif

        <span class="task-tickets">+{{ $task->reward }}</span>
    </div>
</div>
