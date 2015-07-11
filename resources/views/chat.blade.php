@extends('layout')
@section('content')
<div class="starter-template">
    {!! $username !!}
</div>
@stop
@section('title')
    Chat
@stop
@section('username')
    {!! $username !!}
@stop