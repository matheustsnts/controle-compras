@extends('adminlte::page')

@section('title', 'Editar um Sorteio')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<form action = {{ route('alterar_sorteio', $sorteio->id) }} method="POST">
    @csrf
    <label for="">Departamento_Id</label> <br>
    <input type="hidden" name="departamento_id" class="form-control" value="{{ $sorteio->departamento_id }}"> <br>
    <label for="">Status</label> <br>
    <input type="text" name="status" class="form-control"> <br>
    <button class="btn btn-success">Salvar</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
