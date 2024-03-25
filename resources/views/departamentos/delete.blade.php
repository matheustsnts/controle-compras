@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Apagar departamento</h1>
@stop

@section('content')
    <div class="text-center">
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">{{ __("Excluir cadastro de {$departamento->nome}") }}</div>
                    <form action="{{ route('deletar_departamento', $departamento->id) }}" method="POST">
                        @csrf
                        <label for="" class="form-label">Tem certeza que você deseja excluir este departamento?</label>
                        <br>
                        <input type="text" class="form-control" name="nome" value="{{ $departamento->nome }}">
                        <br/>
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="{{ route('departamentos.index') }}"><button type="button"
                                class="btn btn-success">Não</button></a>


                    </form>

                </div>
            </div>
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
