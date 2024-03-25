@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Atribuir Departamentos ao Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Atribuir departamentos ao {{ $user->name }}
        </div>
        <div class="card-body">
            <form action="{{ route('users.departamentos.insert', $user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Departamentos</label>
                    @foreach ($departamentos as $departamento)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $departamento->id }}" name="departamentos[]">
                            <label class="form-check-label">{{ $departamento->nome }}</label>
                        </div>
                    @endforeach

                </div>

                <button type="submit" class="btn btn-success">Inserir</button>
                <a href="{{ route('departamentos.create') }}" class="btn btn-primary" type="button">Criar Departamento</a>
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
