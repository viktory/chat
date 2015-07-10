<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Login/Registration</title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{!! url('/')!!}">Chat</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div>
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <div class="col-lg-6">
            <p>Sign up</p>
            @foreach($errors->registration->all() as $error)
                <p class="bg-danger">{{ $error }}</p>
            @endforeach

            {!! Form::open(['route' => 'registration', 'class' => 'form']) !!}
            <div class="form-group">
                {!! Form::label('Your Name') !!}
                {!! Form::text('username', null, ['required', 'class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Your E-mail Address') !!}
                {!! Form::text('email', null, ['required', 'class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Your Password') !!}
                {!! Form::password('password', ['required', 'class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Sign up', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-6">
            <p>Sign in</p>

            @foreach($errors->login->all() as $error)
                <p class="bg-danger">{{ $error }}</p>
            @endforeach


            {!! Form::open(['route' => 'login', 'class' => 'form']) !!}
            <div class="form-group">
                {!! Form::label('Your Name') !!}
                {!! Form::text('username', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Your E-mail Address') !!}
                {!! Form::text('email', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Your Password') !!}
                {!! Form::password('password', ['class'=>'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Sign in', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>

<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>

