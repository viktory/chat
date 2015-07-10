@extends('layout')
@section('content')
<div class="starter-template">
    @include('_form', ['type' => 'registration'])
    @include('_form', ['type' => 'login'])
</div>
@stop
@section('title')
    Login/Registration
@stop