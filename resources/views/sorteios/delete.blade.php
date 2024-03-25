@extends('adminlte::page')

@section('title', 'Excluir um Sorteio')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<form action = {{ route('excluir_sorteio', $sorteio->id) }} method="POST">
    @csrf
    <label for="">Tem certeza que você apagar este Sorteio?</label> <br>
    <input type="text" name="departamento_id" value="{{ $sorteio->departamento_id }}"> <br>
    <label for="">Tem certeza que você apagar este Sorteio?</label> <br>
    <input type="text" name="data_inicio" value="{{ $sorteio->data_inicio}} "> <br>
    <label for="">Tem certeza que você apagar este Sorteio?</label> <br>
    <input type="text" name="data_fim" value="{{ $sorteio->data_fim }}"> <br>
    <label for="">Tem certeza que você apagar este Sorteio?</label> <br>
    <input type="text" name="status" value="{{ $sorteio->status }}"> <br>
    <button>Sim</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop