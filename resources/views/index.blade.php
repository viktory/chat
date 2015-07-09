<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div>
                    <ul>
                        @foreach($errors->registration->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

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
                            {!! Form::password('password', null, ['required', 'class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Sign up', ['class'=>'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div>
                    <ul>
                        @foreach($errors->login->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

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
                            {!! Form::password('password', null, ['required', 'class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Sign up', ['class'=>'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </body>
</html>
