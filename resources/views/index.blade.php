@extends('layout')
@section('content')
<div class="starter-template">
    @include('_form', ['text' => 'Sign in', 'errorBag' => 'login', 'route' => 'login', 'inputOptions' => ['class'=>'form-control']])
    @include('_form', ['text' => 'Sign up', 'errorBag' => 'registration', 'route' => 'registration', 'inputOptions' => ['class'=>'form-control', 'required']])
</div>
@stop
@section('title')
    Login/Registration
@stop