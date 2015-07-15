@extends('layout')
@section('content')
<div class="starter-template">
    @include('chat._message', ['messages' => $messages, 'isAdmin' => false])
</div>
@stop
@section('title')
    History
@stop
@section('username')
    {!! $currentUser->username !!}
@stop