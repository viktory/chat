@extends('layout')
@section('content')
<div class="starter-template">
    @include('_form', ['text' => 'Sign up', 'errorBag' => 'registration', 'route' => 'registration', 'inputOptions' => ['class'=>'form-control', 'required']])
    <div class="col-lg-2"></div>
    @include('_form', ['text' => 'Sign in', 'errorBag' => 'login', 'route' => 'login', 'inputOptions' => ['class'=>'form-control']])
</div>
@stop
@section('title')
    Login/Registration
@stop