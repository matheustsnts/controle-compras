@extends('adminlte::page')

@section('title', 'Cadastrar um novo Sorteado')

@section('content_header')
    <h1 class="text-center">Criar um novo Sorteado</h1>
@stop

@section('content')
    <form action={{ route('registrar_sorteado') }} method="POST">
        @csrf
        <label for="">Sorteados</label> <br>
        <input type="text" name="sorteados" class="form-control"> <br>
        <label for="">Produtos</label> <br>
        <input type="text" name="produtos" class="form-control"> <br>
        <label for="">Sorteio_Id</label> <br>
        <input type="text" name="sorteio_id" class="form-control" value="{{ $sorteado->sorteio_id }}"> <br>
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
