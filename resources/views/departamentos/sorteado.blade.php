@extends('adminlte::page')

@section('title', 'Sorteado')

@section('content_header')
    <h1 class="text-center">Sorteado</h1>
@stop

@section('content')

    @if (session()->has('alert1'))
        <script>
            alert(`{{ session('alert1') }}`)
        </script>
    @endif

    @if (session()->has('alert2'))
        <script>
            alert(`{{ session('alert2') }}`)
        </script>
    @endif

    @if (session()->has('alert3'))
        <script>
            alert(`{{ session('alert3') }}`)
        </script>
    @endif

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
                            <td>{{ $data->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
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
