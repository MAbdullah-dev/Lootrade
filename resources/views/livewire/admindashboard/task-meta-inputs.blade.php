{{-- Discord (simple) --}}
@if ($platform === 'discord' && $action === 'join_server')
    <input type="text" wire:model="meta.guildId" class="form-control mt-2" placeholder="Guild ID">
    <input type="text" wire:model="link" class="form-control mt-2" placeholder="Task Link">
@endif


{{-- Discord Native --}}
@if ($platform === 'discord_native')
    <input type="text" wire:model="meta.description" class="form-control mt-2"
        placeholder="Short description (e.g. Go to #general and react 👍 to the pinned post)">
    {{-- Message Task (e.g. raffle entry, trigger word, in specific channel) --}}
    @if ($action === 'message')
        <input type="text" wire:model="meta.channelId" class="form-control mt-2" placeholder="Channel ID">
        <input type="text" wire:model="meta.match" class="form-control mt-2" placeholder="Match Text (trigger)">
    @endif

    {{-- Reaction Task --}}
    @if ($action === 'reaction')
        <input type="text" wire:model="meta.messageId" class="form-control mt-2" placeholder="Message ID">
        <input type="text" wire:model="meta.emoji" class="form-control mt-2" placeholder="Emoji (e.g. 👍)">
    @endif

    {{-- Role Task --}}
    @if ($action === 'role')
        <input type="text" wire:model="meta.roleId" class="form-control mt-2" placeholder="Role ID">
    @endif

    {{-- Join Guild (bot detected) --}}
    {{-- @if ($action === 'join')
        <p class="mt-2 text-muted">No extra fields required for Join Guild.</p>
    @endif --}}

    {{-- Attachment Task --}}
    @if ($action === 'attachment')
        <input type="text" wire:model="meta.channelId" class="form-control mt-2" placeholder="Channel ID">
    @endif

    {{-- Reply Task --}}
    @if ($action === 'reply')
        <input type="text" wire:model="meta.parentMessageId" class="form-control mt-2"
            placeholder="Parent Message ID">
    @endif

    {{-- Thread Participation Task --}}
    @if ($action === 'thread')
        <input type="text" wire:model="meta.threadId" class="form-control mt-2" placeholder="Thread ID">
    @endif

    {{-- Mention Task --}}
    @if ($action === 'mention')
        <input type="text" wire:model="meta.channelId" class="form-control mt-2" placeholder="Channel ID">
    @endif

    {{-- Live Event Chat --}}
    @if ($action === 'live_event')
        <input type="text" wire:model="meta.channelId" class="form-control mt-2" placeholder="Channel ID">
    @endif

@endif


{{-- YouTube --}}
@if ($platform === 'youtube' && $action === 'watch_video')
    <input type="text" wire:model="meta.videoId" class="form-control mt-2" placeholder="Video ID">
    <input type="number" wire:model="meta.duration" class="form-control mt-2" placeholder="Duration (seconds)">
    <input type="text" wire:model="link" class="form-control mt-2" placeholder="Task Link">
@endif

@if ($platform === 'youtube' && $action === 'like_video')
    <input type="text" wire:model="meta.videoId" class="form-control mt-2" placeholder="Video ID">
    <input type="text" wire:model="link" class="form-control mt-2" placeholder="Task Link">
@endif


{{-- X (Twitter) --}}
@if ($platform === 'x' && $action === 'follow_user')
    <input type="text" wire:model="meta.username" class="form-control mt-2" placeholder="Target Username">
    <input type="text" wire:model="meta.targetUserId" class="form-control mt-2" placeholder="Target User ID">
    <input type="text" wire:model="link" class="form-control mt-2" placeholder="Task Link">
@endif

@if ($platform === 'x' && $action === 'like_tweet')
    <input type="text" wire:model="meta.tweetId" class="form-control mt-2" placeholder="Tweet ID">
    <input type="text" wire:model="link" class="form-control mt-2" placeholder="Task Link">
@endif

@if ($platform === 'x' && $action === 'repost_tweet')
    <input type="text" wire:model="meta.tweetId" class="form-control mt-2" placeholder="Tweet ID">
    <input type="text" wire:model="link" class="form-control mt-2" placeholder="Task Link">
@endif
