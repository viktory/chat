@extends('layout')
@section('content')
<div class="starter-template">

    <div class="col-lg-4 user-block">
        @include('chat._dialogs')
    </div>
    <div class="col-lg-8">
        <div class="chat-block">
            @include('chat._chat')
        </div>
    </div>

</div>
@stop
@section('title')
    Admin Page
@stop
@section('username')
    {!! $currentUser->username !!}
@stop

@section('chat_script')
    <script>
        $(document).ready(function(){
            $("#message").chat({
                uri: "<?= str_replace(['http://', 'https://'], '', \Illuminate\Support\Facades\URL::to('/'))?>",
                currentUserId: {{ $currentUser->id }},
                isAdmin: true,
                deleteActionName: "{{ $deleteActionName }}"
            })
        });
    </script>
@stop