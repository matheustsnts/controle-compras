@extends('adminlte::page')

@section('title', "Usuário $user->name")

@section('content_header')
    <h1 class="text-center">Usuário {{ $user->name }}</h1>
@stop

@section('content')
    <div class="text-center">
        <div class="card">
            {{-- @if ($user->isEmpty())
                Não tem usuários disponiveis
            @else --}}
            <div class="card-body">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Departamento</th>
                            <th>Status</th>
                            @canany(['nivel-1', 'nivel-2', 'nivel-3'])
                                <th width="1%"></th>
                            @else
                                <th width="2%"></th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="10%">{{ $user->name }}</td>
                            <td width="10%">{{ $user->email }}</td>
                            @if ($user->departamentos->isEmpty())
                                <td>Nenhum departamento disponível</td>
                            @else
                                <td width="10%">
                                    @foreach ($user->departamentos as $item)
                                        {{ $item->nome }}
                                    @endforeach
                                </td>
                            @endif
                            @if ($user->admin == false)
                                <td width="10%">Usuário</td>
                            @else
                                <td width="10%">Administrador</td>
                            @endif
                            @canany(['nivel-1', 'nivel-2', 'nivel-3', 'nivel-4'])
                                <td class="space">
                                    &nbsp;
                                    <a href="{{ route('users.edit') }}" class=""><i class="fas fa-edit"></i></a>
                                </td>
                            @else
                                <td class="space">
                                    &nbsp;
                                    <a href="{{ route('users.edit') }}" class=""><i class="fas fa-edit"></i></a>
                                    {{-- <a href="{{ route('users.delete') }}" class="fas fa-backspace"></a> --}}
                                    &nbsp;
                                    &nbsp;
                                    <form name="btn-excluir" action="{{ route('deletar_user', $user->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                                        <a href="#" type="button" id="{{ $user->id }}" class="btn-exclusao"><i
                                                class="fas fa-backspace"></i></a>
                                    </form>
                                </td>
                            @endcanany
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
    @canany(['nivel-1', 'nivel-2', 'nivel-3', 'nivel-4'])
    @else
        <p><a href="{{ route('users.create') }}" class="btn btn-info">Editar Usuário</a></p>
    @endcanany


    {{-- @endif --}}
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
    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script>
        $('.btn-exclusao').click(function(e) {
            e.preventDefault();

            var id = $(this).attr('id');

            Swal.fire({
                title: 'Você tem certeza que quer deletar a sua conta?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#5cb85c',
                confirmButtonText: `Sim`,
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.forms['btn-excluir'].submit();
                }
            })
        })
    </script>

@stop
