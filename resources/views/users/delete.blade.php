@extends('adminlte::page')

@section('title', "Apagar Usuário $user->name")

@section('content_header')
    <h1 class="text-center">Apagar Usuário {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card-body">
        <h5>Tem certeza que você quer apagar o usuário {{ $user->name }}?</h2>
            <div>
                <form action="{{ route('deletar_user', $user->id) }}" method="POST">
                    @csrf
                    <a href="{{ route('users.show', $user->id) }}"  type="button" class="btn btn-success">Não</a>
                    <button class="btn btn-danger" type="submit">Sim</button>
                </form>
            </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
