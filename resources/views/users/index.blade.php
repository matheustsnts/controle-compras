@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Usuários</h1>
@stop

@section('content')
    <div class="text-center">

        {{-- <div class="card">
            @can(nivel - 1)
                @if ($user->isEmpty())
                Não tem usuários disponiveis
                <div class="card-body">
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Departamento</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $users)
                                <tr>
                                    <td width="45%">{{ $users->name }}</td>
                                    @if ($users->departamentos->isEmpty())
                                        <td>Departamento indisponível</td>
                                    @else
                                        @foreach ($users->departamentos as $item)
                                            <td>{{ $item->nome }}</td>
                                        @endforeach
                                    @endif
                                    <td width="10%">
                                        @if ($users->departamentos->isEmpty())
                                            <a href="#" class="fas fa-eye aviso2"></a>
                                            &nbsp;
                                            &nbsp;
                                            <a href="{{ route('users.departamentos', $users->id) }}"
                                                class="fas fa-building"></a>
                                        @else
                                            <a href="{{ route('users.show', $users->id) }}" class="fas fa-eye"></a>
                                            &nbsp;
                                            &nbsp;
                                            <a href="" class="fas fa-building aviso"></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endcan
        </div> --}}

        {{-- <div class="card">

            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Departamento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departamento->users as $users)
                            <tr>
                                <td width="45%">{{ $users->name }}</td>
                                

                                <td>{{ $departamento->nome }}</td>

                                <td width="10%">
                                    @if ($users->departamentos->isEmpty())
                                        <a href="#" class="fas fa-eye aviso2"></a>
                                        &nbsp;
                                        &nbsp;
                                        <a href="{{ route('users.departamentos', $users->id) }}" class="fas fa-building"></a>
                                    @else
                                        <a href="{{ route('users.show', $users->id) }}" class="fas fa-eye"></a>
                                        &nbsp;
                                        &nbsp;
                                        <a href="" class="fas fa-building aviso"></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div> --}}


        <div class="card">

            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Departamento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="45%">{{ $userAuth->name }}</td>
                            <td>{{ $departamento->nome }}</td>
                            <td width="10%">
                                <a href="{{ route('users.show') }}" class="fas fa-eye"></a>
                                {{-- &nbsp;
                                &nbsp;
                                <a href="" class="fas fa-building aviso"></a> --}}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>



        </div>

    </div>

    {{-- <p><a href="{{ route('users.create') }}" class="btn btn-info">Criar Usuário</a></p> --}}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
@stop

@section('js')

    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.aviso').on('click', function() {
            window.alert(`Usuário já tem departamento cadastrado no sistema`)
        })
        $('.aviso2').on('click', function() {
            window.alert(`Como não existe departamento para o usuário, impossível!!!`)
        })
    </script>
@stop
