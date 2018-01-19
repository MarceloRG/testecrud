@extends('layouts.app')
@section('content')
    <div class="container">
        {!! Form::model($contato,['route'=>['update', 'id' => $contato->id], 'method'=> 'PUT']) !!}
        @include('site._form', ['button' => 'Salvar Alterações'])
        {!! Form::close() !!}
    </div>
@stop