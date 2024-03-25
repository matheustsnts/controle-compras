@extends('adminlte::page')

@section('title', "Sorteio em $departamento->nome")

@section('content_header')
    <h1 class="text-center">Departamento</h1>
@stop

@section('content')


    @if (session()->has('vazio'))
        <div class="alert alert-success">
            {{ session('vazio') }}
        </div>
    @endif

    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header pb-0 border-bottom-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title text-muted">
                            Departamento
                        </h3>
                        @canany(['nivel-1', 'nivel-2', 'nivel-3', 'nivel-4'])
                            <div class="card-tools">
                                <a href="{{ route('departamentos.edit', ['id' => $departamento->id]) }}" class="fas fa-edit"></a>
                            </div>
                        @endcanany
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="mt-2">
                        <h3>
                            {{ $departamento->nome }}
                        </h3>
                    </div>
                </div>
            </div>


            <div class="col-sm3">
                <div class="card">
                    <div class="card-header pb-0 border-bottom-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title text-muted">
                                Produtos
                            </h3>
                            @can('admin')
                                <div class="card-tools">
                                    <a href="{{ route('departamentos.produtos', $departamento->id) }}"
                                        class="small-box-footer"><i class="fab fa-app-store-ios"></i></a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="mt-2">
                            @if ($departamento->produtos->isEmpty())
                                Não há produtos nesse departamento
                                <br>
                                <br>
                                <div class="text-center">
                                    @can('admin')
                                        <a href="{{ route('departamentos.produtos', $departamento->id) }}"
                                            class="btn btn-primary">Adicionar Produtos</a>
                                    @endcan
                                </div>
                            @else
                                <table class="table table-borderless">
                                    <thead>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        @foreach ($departamento->produtos as $produtos)
                                            <tr>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        {{ $produtos->nome }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <form
                                                            action="{{ route('departamentos.showDeleteProduto', ['id' => $departamento->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" value="{{ $produtos->id }}"
                                                                name="produto_id">
                                                            @can('admin')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            @endcan
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                @can('admin')
                                    <div class="text-center">
                                        <a href="{{ route('departamentos.produtos', $departamento->id) }}"
                                            class="btn btn-primary">Adicionar Produtos</a>
                                    </div>
                                @endcan
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    @if ($departamento->users->isEmpty())
                        Não tem usuários no departamento de {{ $departamento->nome }}
                        <div class="card-body pad table-responsive text-center ">
                            <a href="{{ route('departamento.usuarios', $departamento->id) }}"
                                class="btn btn-primary">Adicionar um usuário ao departamento de
                                {{ $departamento->nome }}</a>
                        </div>
                    @else
                        <h4>Usuarios que estão na {{ $departamento->nome }}</h4>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center">Nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departamento->users->sortBy('name') as $users)
                                    @if ($users->nivel === null)
                                        <tr id="tr{{ $users->id }}">
                                            <td>
                                                <div class="input-group mb-3">
                                                    {{ $users->name }}
                                                </div>
                                            </td>
                                            <td>
                                                @can('admin')
                                                    @if (Auth::user()->id != $users->id)
                                                        <div class="input-group mb-3">
                                                            <form
                                                                action="{{ route('departamentos.showDelete', ['id' => $departamento->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" value="{{ $users->id }}"
                                                                    name="user_id">
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                            &nbsp;&nbsp;
                                                            @if ($users->admin == false)
                                                                <input type="hidden" value="{{ $users->id }}"
                                                                    name="user_id">
                                                                <button type="button" class="btn btn-warning btn-admin-class"
                                                                    data-toggle="collapse" id="{{ $users->id }}">
                                                                    <i class="fas fa-lock-open"></i>
                                                                </button>
                                                            @else
                                                                <input type="hidden" value="{{ $users->id }}"
                                                                    name="user_id">
                                                                <button type="button" class="btn btn-warning btn-admin-class"
                                                                    data-toggle="collapse" id="{{ $users->id }}">
                                                                    <i class="fas fa-lock"></i>
                                                                </button>
                                                            @endif
                                                            {{-- <input type="hidden" name="admin-user" value="{{ $users->id }}"
                                                            id="admin-user"> --}}
                                                        </div>
                                                    @else
                                                        <div class="input-group mb-3">
                                                            @if ($users->admin == false)
                                                                <input type="hidden" value="{{ $users->id }}"
                                                                    name="user_id">
                                                                <button type="button" class="btn btn-warning btn-admin-class"
                                                                    data-toggle="collapse" id="{{ $users->id }}">
                                                                    <i class="fas fa-lock-open"></i>
                                                                </button>
                                                            @else
                                                                <form name="btn-autenticado" action="{{ route('admin_user') }}"
                                                                    method="POST" id="btn-autenticado">
                                                                    @csrf
                                                                    <input type="hidden" value="{{ $users->id }}"
                                                                        name="user_id">
                                                                    <button type="button"
                                                                        class="btn btn-warning btn-admin-class"
                                                                        data-toggle="collapsed" id="{{ $users->id }}">
                                                                        <i class="fas fa-lock"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            {{-- <input type="hidden" name="admin-user" value="{{ $users->id }}"
                                                            id="admin-user"> --}}
                                                        </div>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @can('admin')
                            <div class="card-body pad table-responsive text-center ">
                                <a href="{{ route('departamento.usuarios', $departamento->id) }}"
                                    class="btn btn-primary">Adicionar um usuário ao departamento de
                                    {{ $departamento->nome }}</a>
                            </div>
                        @endcan
                    @endif
                </div>
            </div>

            <p class="text-center">
                {{-- <button class="btn bg-gradient-info btn-lg" class="btn btn-default" data-toggle="modal"
                    data-target="#sorteado" onclick="mostrar()">Sortear</button> --}}

                <input type="hidden" name="departamento_id" value="{{ $departamento->id }}" id="departamento">
                <button class="btn-open-sortear btn btn-info btn-lg" data-toggle="modal"
                    id="btn-sortear">Sortear</button>

            </p>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Sorteado</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div id="minhaModal-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/botao.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
@stop


@section('js')

    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

    @if (session()->has('updated'))
        <script>
            toastr.success(`{{ session('updated') }}`)
        </script>
    @endif

    @if (session()->has('add'))
        <script>
            toastr.success(`{{ session('add') }}`)
        </script>
    @endif

    @if (session()->has('not_admin'))
        <script>
            toastr.info(`{{ session('not_admin') }}`)
        </script>
    @endif

    @if (session()->has('produtos_inseridos'))
        <script>
            toastr.success(`{{ session('produtos_inseridos') }}`)
        </script>
    @endif


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $("input[name=departamento_id]").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        var hh = String(today.getHours()).padStart(2, '0');
        var mn = String(today.getMinutes()).padStart(2, '0');
        var ss = String(today.getSeconds()).padStart(2, '0');

        var href = `{{ route('sorteios.store') }}`

        $('.btn-open-sortear').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: href,
                method: 'POST',
                data: {
                    departamento_id: id
                },
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(data) {
                    if (data.alerta === undefined) {
                        if (data.menor === undefined) {
                            if (data.aviso === undefined) {
                                if (data.msg === undefined) {
                                    $('#myModal').modal('show')
                                    $('#minhaModal-2').html(`<div class="modal-body">
                                <div class="table-responsive-xl">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Departamento</th>
                                                <th>Produto</th>
                                                <th>Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>${data.sorteado}</td>
                                                <td>{{ $departamento->nome }}</td>
                                                <td>${data.produto}</td>
                                                <td>${data.data}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>`).show()
                                } else {
                                    toastr.info(data.msg)
                                }
                            } else {
                                toastr.error(data.aviso)
                            }
                        } else {
                            toastr.error(data.menor)
                        }
                    } else {
                        toastr.error(data.alerta)
                    }

                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error, data) {
                    toastr.error(
                        "Usuário e Produtos não cadastrados. Por favor, Cadastre-os no departamento de {{ $departamento->nome }}"
                    );
                    $('#loader').hide();
                }
            })
        })

        $(".remover-admin").on('click', function(e) {

            e.preventDefault();

            var input_type = $(this).attr('name:')

            $('this').hasClass('fas fa-lock-open') ? $(this).removeClass('fas fa-lock-open')
                .addClass('fas fa-lock') : $(this).removeClass('fas fa-lock').addClass(
                    'fas fa-lock-open')
        });

        function mostrar(e) {
            if (e.classList.contains("fas fa-lock-open")) { //se tem olho aberto
                e.classList.remove("fas fa-lock-open"); //remove classe olho aberto
                e.classList.add("fas fa-lock"); //coloca classe olho fechado
            } else {
                e.classList.remove("fas fa-lock"); //remove classe olho fechado
                e.classList.add("fas fa-lock-open"); //coloca classe olho aberto
            }
        }

        $('.btn-admin-class').click(function(e) {
            e.preventDefault();
            //// console.log(id)
            var id = $(this).attr('id')
            var autenticado = `{{ Auth::user()->id }}`

            if (autenticado === id) {
                Swal.fire({
                    title: 'Você tem certeza que quer deixar de ser administrador?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d9534f',
                    cancelButtonColor: '#5cb85c',
                    confirmButtonText: `Sim`,
                    cancelButtonText: 'Não'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.forms['btn-autenticado'].submit();
                    }
                })

            } else {
                $(this).children().toggleClass('fas fa-lock-open fas fa-lock')
                $.ajax({
                    url: `{{ route('admin_user') }}`,
                    method: 'POST',
                    data: {
                        user_id: id
                    },
                    success: function(data) {
                        if (data.admin == true) {
                            Swal.fire({
                                imageUrl: `{{ asset('img/lock.svg') }}`,
                                imageWidth: '75px',
                                title: `O usuário ${data.name} agora é administrador!!!`,
                                confirmButtonColor: '#5cb85c ',
                                confirmButtonText: 'OK',
                            })
                        } else {
                            Swal.fire({
                                imageUrl: `{{ asset('img/unlock.svg') }}`,
                                imageWidth: '100px',
                                iconColor: '#6c757d',
                                title: `O usuário ${data.name} não é mais administrador!!!`,
                                confirmButtonColor: '#d9534f',
                                confirmButtonText: 'OK',
                            })
                        }
                    },
                    error: function(jqXHR, testStatus, error, data) {
                        $('#loader').hide();
                    }
                })
            }


        })
    </script>

    <script>
        $('.apagar_departamento').click(function(e) {
            e.preventDefault();

            Swal.fire({
                title: `Você tem certeza que deseja apagar este departamento?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#5cb85c',
                confirmButtonText: `Sim`,
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.forms['departamento_apagar'].submit();
                }
            })
        })
    </script>

@stop
