@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Atribuir {{ $user->name }} ao Departamento abaixo:</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Atribuir {{ $user->name }} aos Departamento:
        </div>
        <div class="card-body">

            <form action="{{ route('users.departamentos.insert', $user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Departamentos</label>
                    @foreach ($departamento as $departamentos)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="{{ $departamentos->id }}" name="departamentos[]">
                            <label class="form-check-label">{{ $departamentos->nome }}</label>
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
