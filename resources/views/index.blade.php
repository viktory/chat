<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                {!! Form::open(array('route' => 'registration', 'class' => 'form')) !!}

                <div class="form-group">
                    {!! Form::label('Your Name') !!}
                    {!! Form::text('username', null,
                    array('required',
                    'class'=>'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Your E-mail Address') !!}
                    {!! Form::text('email', null,
                    array('required',
                    'class'=>'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Your Password') !!}
                    {!! Form::password('password', null,
                    array('required',
                    'class'=>'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Sign up',
                    array('class'=>'btn btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </body>
</html>
