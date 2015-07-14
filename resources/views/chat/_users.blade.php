<div class="list-group">
    @foreach ($users as $user)
        <a href="#" class="list-group-item" data-id="{{ $user->id }}" data-url="{{ route('load_history', ['id' => $user->id]) }}">
            {{ $user->id }} {{ $user->username }}
            <span class="counter"></span>
        </a>
    @endforeach
</div>