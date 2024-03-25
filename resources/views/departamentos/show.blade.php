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
                        <div class="card-tools">
                            <a href="{{ route('departamentos.edit', ['id' => $departamento->id]) }}" class="fas fa-edit"></a>
                            <a href="{{ route('departamentos.delete', ['id' => $departamento->id]) }}"
                                class="fas fa-backspace"></a>
                        </div>
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
                            <div class="card-tools">
                                <a href="{{ route('departamentos.produtos', $departamento->id) }}"
                                    class="small-box-footer"><i class="fab fa-app-store-ios"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="mt-2">
                            @if ($departamento->produtos->isEmpty())
                                Não há produtos nesse departamento
                                <br>
                                <br>
                                <div class="text-center">
                                    <a href="{{ route('departamentos.produtos', $departamento->id) }}"
                                        class="btn btn-primary">Adicionar Produtos</a>
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
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class="text-center">
                                    <a href="{{ route('departamentos.produtos', $departamento->id) }}"
                                        class="btn btn-primary">Adicionar Produtos</a>
                                </div>
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
                                    <tr>
                                        <td>
                                            <div class="input-group mb-3">
                                                {{ $users->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <form
                                                    action="{{ route('departamentos.showDelete', ['id' => $departamento->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{ $users->id }}" name="user_id">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-body pad table-responsive text-center ">
                            <a href="{{ route('departamento.usuarios', $departamento->id) }}"
                                class="btn btn-primary">Adicionar um usuário ao departamento de
                                {{ $departamento->nome }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <p class="text-center">
                {{-- <button class="btn bg-gradient-info btn-lg" class="btn btn-default" data-toggle="modal"
                    data-target="#sorteado" onclick="mostrar()">Sortear</button> --}}

                <input type="hidden" name="departamento_id" value="{{ $departamento->id }}" id="departamento">
                <button class="btn-open-sortear btn btn-info btn-lg" data-toggle="modal" id="btn-sortear">Sortear</button>
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

    {{-- <form action={{ route('registrar_sorteio') }} method="POST">
        @csrf
        <input type="hidden" name="departamento_id" class="form-control" value="{{ $departamento->id }}"> <br>
        <label for="">Status</label> <br>
        <input type="text" name="status" class="form-control"> <br>
        <button class="btn btn-success">Salvar</button>
    </form> --}}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

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



        //console.log(id);

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
                                alert(data.msg)
                            }
                        } else {
                            alert(data.aviso)
                        }
                    } else {
                        alert(data.alerta)
                    }
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error, data) {
                    console.log(error, data);
                    alert(
                        "Usuário e Produtos não cadastrados. Por favor, Cadastre-os no departamento de {{ $departamento->nome }}"
                    );
                    $('#loader').hide();
                }
            })
        })
    </script>
@stop
