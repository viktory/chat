<div class="list-group">
    @forelse ($users as $user)
        <a href="{{ route('load-history', ['from' => $user->id]) }}" class="list-group-item" data-id="{{ $user->id }}">
            {{ $user->username }}
            <span class="counter"></span>
        </a>
    @empty
        <div class="alert alert-warning">You are the only user</div>
    @endforelse
</div>