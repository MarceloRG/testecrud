@extends('layouts.app')
@section('content')
    <div class="container">
        {!! Form::open(['route' => ['store']]) !!}
        @include('site._form', ['button' => 'Cadastrar'])
        {!! Form::close() !!}
    </div>
@stop