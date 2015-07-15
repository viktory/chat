<div class="list-group">
    @forelse ($dialogs as $dialog)
        <a href="{{ route('load-history', ['from' => $dialog->from, 'to' => $dialog->to]) }}" class="list-group-item" data-from="{{ $dialog->from }}" data-to="{{ $dialog->to }}">
            {{ $dialog->sender->username }} &amp; {{ $dialog->addressee->username }}
            <span class="counter"></span>
        </a>
    @empty
        <div class="alert alert-warning">Unfortunately, users don't want to chat(</div>
    @endforelse
</div>