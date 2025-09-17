<section class="admin-tasks" aria-label="Admin Tasks Section">
    <div class="container">
        <div class="inner">
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <input type="text" placeholder="Search Tasks" class="form-control search-bar">
                </div>
                <div class="col-md-6 text-md-end">
                    <button wire:click="openModal" class="btn-custom p-2">Create Task</button>
                </div>
            </div>

            <div class="table-responsive rounded shadow">
                <table class="table table-neon table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Platform</th>
                            <th>Action</th>
                            <th>Reward</th>
                            <th>Meta</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            @php
                                $last = $task->lastExecution;
                            @endphp
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->platform }}</td>
                                <td>{{ $task->action }}</td>
                                <td>{{ $task->reward }}</td>
                                <td><code>{{ Str::limit(json_encode($task->meta), 40) }}</code></td>
                                <td>
                                    <button wire:click="toggleActive({{ $task->id }})"
                                        class="btn btn-sm {{ $task->is_active ? 'btn-success' : 'btn-danger' }}">
                                        {{ $task->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td>
                                    <button wire:click="deleteTask({{ $task->id }})"
                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No tasks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            {{-- Modal --}}
            @if ($showModal)
                <div class="modal fade show d-block" style="background:rgba(0,0,0,0.5)">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Create Task</h5>
                                <button type="button" wire:click="$set('showModal', false)" class="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- Username --}}
                                @if ($platform && $platform !== 'discord_native')
                                    <input class="form-control mb-2" type="text"
                                        placeholder="Username of the account used in platform" wire:model="username">
                                @endif
                                @error('username')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                {{-- Platform --}}
                                <select class="form-control mb-2" wire:model.lazy="platform">
                                    <option value="">Select Platform</option>
                                    <option value="discord">Discord</option>
                                    <option value="discord_native">Discord Native</option>
                                    <option value="youtube">YouTube</option>
                                    <option value="x">X</option>
                                </select>
                                @error('platform')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                {{-- Action --}}
                                @if ($platform)
                                    <select class="form-control mb-2" wire:model.lazy="action">
                                        <option value="">Select Action</option>
                                        @if ($platform === 'discord')
                                            <option value="join_server">Join Server</option>
                                        @elseif($platform === 'discord_native')
                                            <option value="message">Message</option>
                                            <option value="reaction">Reaction</option>
                                            <option value="role">Role</option>
                                            <option value="attachment">Attachment</option>
                                            <option value="reply">Reply</option>
                                            <option value="thread">Thread</option>
                                            <option value="mention">Mention Bot</option>
                                            <option value="live_event">Live Event</option>
                                        @elseif($platform === 'youtube')
                                            <option value="watch_video">Watch Video</option>
                                            <option value="like_video">Like Video</option>
                                        @elseif($platform === 'x')
                                            <option value="follow_user">Follow</option>
                                            <option value="like_tweet">Like Tweet</option>
                                            <option value="repost_tweet">Repost Tweet</option>
                                        @endif
                                    </select>
                                @endif

                                {{-- Dynamic Meta Inputs --}}
                                @include('livewire.admindashboard.task-meta-inputs')
                                @foreach ($errors->get('meta.*') as $field => $messages)
                                    @foreach ($messages as $message)
                                        <div class="text-danger small">{{ $message }}</div>
                                    @endforeach
                                @endforeach
                                <input type="number" class="form-control mt-2" wire:model="reward"
                                    placeholder="Reward">
                                @error('reward')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button wire:click="save" class="btn btn-success">Save</button>
                                <button wire:click="$set('showModal', false)" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
