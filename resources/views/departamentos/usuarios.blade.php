@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Atribuir Departamentos ao Usuário {{ $departamento->nome }}</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            Atribuir usuários ao {{ $departamento->nome }}
        </div>
        <div class="card-body">
            @if ($user->isEmpty())
                Todos os usuarios já estão cadastrados no sistema.
                <br>
                <br>
            @else
                <form action="{{ route('departamento.usuarios.update', $departamento->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Usuários</label>
                        @foreach ($user as $users)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $users->id }}" name="users[]">
                                <label class="form-check-label">{{ $users->name }}</label>
                            </div>
                        @endforeach
                        @error('erro_user')
                            <span class="cor">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Inserir</button>
                </form>
            @endif
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/botao.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
