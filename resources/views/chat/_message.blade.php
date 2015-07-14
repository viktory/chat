@foreach($messages as $message)
    <div class="message-block" data-from="{{ $message->from }}" data-to="{{ $message->to }}">
        <div class="header">
            <div class="username">{{ $message->sender->username }}</div>
            <div class="date">{{ $message->created_at }}</div>
        </div>
        <div class="text">{{ $message->text }}</div>
    </div>
@endforeach