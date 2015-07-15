<div class="col-lg-5 well">
    <p>{{ $text }}</p>
    @foreach($errors->$errorBag->all() as $error)
        <p class="bg-danger">{{ $error }}</p>
    @endforeach

    {!! Form::open(['route' => $route, 'class' => 'form']) !!}
    <div class="form-group">
        {!! Form::label('Your Name') !!}
        {!! Form::text('username', null, $inputOptions) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Your E-mail Address') !!}
        {!! Form::text('email', null, $inputOptions) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Your Password') !!}
        {!! Form::password('password', ['required', 'class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit($text, ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>