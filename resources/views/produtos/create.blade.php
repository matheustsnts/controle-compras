@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Produtos</h1>
@stop

@section('content')
    <form action="{{ route('registrar_produto') }}" method="POST">
        @csrf
        <label for="">Nome</label> <br>
        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror">
        @error('nome')
            <span class="cor" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            <br>
        @enderror
        <br>
        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('produtos.index') }}" class="btn btn-primary">Voltar</a>
    </form>
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
