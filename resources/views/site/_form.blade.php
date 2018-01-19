<!-- Name Form input-->
<div class="form-group">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @if ($errors->has('name')) <span class="text-danger">
        <p class="d-block">{{ $errors->first('name') }}</p></span>
    @endif
</div>
<!-- Email Form input-->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    @if ($errors->has('email')) <span class="text-danger">
        <p class="d-block">{{ $errors->first('email') }}</p></span>
    @endif
</div>
<div class="text-center">
    {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
</div>
