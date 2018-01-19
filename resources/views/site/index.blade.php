@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @isset($contatos)
                @foreach($contatos as $contato)
                    <tr>
                        <th scope="row">{{$contato->id}}</th>
                        <td>{{$contato->name}}</td>
                        <td>{{$contato->email}}</td>
                        <td>
                            <a href="{{route('edit', ['id' => $contato->id])}}" class="btn btn-primary">Editar</a>
                            <a href="{{route('destroy', ['id' => $contato->id])}}" class="btn btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
@stop