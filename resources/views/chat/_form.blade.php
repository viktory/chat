<div class="form-group">
    {!! Form::textarea('notes', null, ['size' => '87x5', 'id' => 'message', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Send', ['class'=>'btn btn-primary', 'id' => 'send-btn', 'disabled' => 'disabled']) !!}
</div>
