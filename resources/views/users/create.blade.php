@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Criar Usuário</h1>
@stop

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="">Nome</label><br>
        <input type="text" name="name" class="form-control @error('erro_nome') is-invalid @enderror">
        @error('erro_nome')
            <span class="cor" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            <br>
        @enderror
        <br>
        <label for="">E-mail</label>
        <input type="email" name="email" class="form-control @error('erro_email') is-invalid @enderror">
        @error('erro_email')
            <span class="cor" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            <br>
        @enderror
        <br>
        <button class="btn btn-success" type="submit">Salvar</button>
        <a href="{{ route('users.show') }}" class="btn btn-primary" type="button">Voltar</a>
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
