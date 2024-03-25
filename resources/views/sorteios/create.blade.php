@extends('adminlte::page')

@section('title', 'Cadastrar um novo Sorteio')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <form action={{ route('registrar_sorteio') }} method="POST">
        @csrf
        <label for="">Departamento_Id</label> <br>
        <input type="text" name="departamento_id" class="form-control"> <br>
        <label for="">Status</label> <br>
        <input type="text" name="status" class="form-control"> <br> <input type="hidden">
        <button class="btn btn-success">Salvar</button>
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
