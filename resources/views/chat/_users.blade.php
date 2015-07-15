<div class="list-group">
    @foreach ($users as $user)
        <a href="{{ route('load-history', ['from' => $user->id]) }}" class="list-group-item" data-id="{{ $user->id }}">
            {{ $user->username }}
            <span class="counter"></span>
        </a>
    @endforeach
</div>