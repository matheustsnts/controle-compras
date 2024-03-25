@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Criar Departamento</h1>
@stop

@section('content')
    <form action="{{ route('departamentos.store') }}" method="POST">
        @csrf
        <label for="">Nome</label> <br>
        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"> <br>
        @error('nome')
            <p class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </p>
        @enderror
        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('departamentos.index') }}" class="btn btn-primary">Voltar</a>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
