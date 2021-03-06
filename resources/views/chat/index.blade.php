@extends('layout')
@section('content')
<div class="starter-template">

    <div class="col-lg-4 user-block">
        @include('chat._users')
    </div>
    <div class="col-lg-8">
        <div class="chat-block">
            @include('chat._chat')
        </div>
        <div class="form-block">
            @include('chat._form')
        </div>
    </div>

</div>
@stop
@section('title')
    Chat
@stop
@section('username')
    {!! $currentUser->username !!}
@stop

@section('chat_script')
    <script>
        $(document).ready(function(){
            $("#message").chat({
                /**
                 * url must be without schema. So we have to remove http://' and 'https://' here or in javascript.
                 * It looks like removing in the template is much better
                 */
                uri: "<?= str_replace(['http://', 'https://'], '', \Illuminate\Support\Facades\URL::to('/'))?>",
                currentUserId: {{ $currentUser->id }},
                createActionName: "{{ $createActionName }}"
            })
        });
    </script>
@stop