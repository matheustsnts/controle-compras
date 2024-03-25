@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Sorteados</h1>
@stop

@section('content')
    <div class="text-center">
        <div class="card">
            @if ($sorteado->isEmpty())
                <div class="card-body">
                    Não tem sorteados disponiveis
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Departamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sorteado as $sorteados)
                                <tr>
                                    <td width="10%">{{ $sorteados->id }}</td>
                                    <td width="40%">{{ $sorteados->nome }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    @endif
    <p><a href="{{ route('sorteados.create') }}" class="btn btn-info">Criar Sorteado</a></p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
