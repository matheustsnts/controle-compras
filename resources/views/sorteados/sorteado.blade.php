@extends('adminlte::page')

@section('title', 'Sorteado')

@section('content_header')
    <h1 class="text-center">Sorteado</h1>
@stop

@section('content')
    <div class="text-center">
        <div class="card">


            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Departamento</th>
                            <th>Produto </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $departamento->users()->inRandomOrder()->first()->name }}</td>
                            <td>{{ $departamento->nome }}</td>
                            <td>{{ $departamento->produtos()->inRandomOrder()->first()->nome }}</td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
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
