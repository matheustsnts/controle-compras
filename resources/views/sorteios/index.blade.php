@extends('adminlte::page')

@section('title', 'Listagem dos últimos sorteios')

@section('content_header')
    <h1 class="text-center">Sorteio</h1>
@stop

@section('content')
    <div class="text-center">
        {{-- @can('nivel-1')
            <div class="card">
                @if ($sorteio->isEmpty())
                    Não tem sorteios disponiveis
                @else
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Departamento</th>
                                    <th>Usuário</th>
                                    <th>Produto</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sorteio as $sorteios)
                                    <tr>
                                        <td width="10%">{{ $sorteios->id }}</td>
                                        <td width="20%">{{ $sorteios->departamento->nome }}</td>
                                        <td width="20%">{{ $sorteios->usuario->name }}</td>
                                        <td width="20%">{{ $sorteios->produto->nome }}</td>
                                        <td width="20%">{{ $sorteios->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td><a href="{{ route('sorteios.show', $sorteios->id) }}" class="fas fa-eye"></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        @endcan --}}

        <div class="card">
            @if ($sorteio->isEmpty())
                Não tem sorteios disponiveis
            @else
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Departamento</th>
                                <th>Usuário</th>
                                <th>Produto</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sorteio as $sorteios)
                                <tr>
                                    <td width="10%">{{ $sorteios->id }}</td>
                                    <td width="20%">{{ $sorteios->departamento->nome }}</td>
                                    <td width="20%">{{ $sorteios->usuario->name }}</td>
                                    <td width="20%">{{ $sorteios->produto->nome }}</td>
                                    <td width="20%">{{ $sorteios->created_at->format('d/m/Y H:i:s') }}</td>
                                    @canany(['nivel-1', 'nivel-2', 'nivel-3','nivel-4'])
                                        <td width="1%">
                                            <form name="apagar_sorteio" action={{ route('excluir_sorteio', $sorteios->id) }}
                                                method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $sorteios->id }}" name="sorteio_id">
                                                <a href="#" type="button" id="{{ $sorteios->id }}"
                                                    class="sorteio_apagar"><i class="fas fa-backspace"></i></a>
                                            </form>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    {{ $sorteio->links('custom.pagination') }}
                </div>
            @endif
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

    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

    <script>
        $('.sorteio_apagar').click(function(e) {
            e.preventDefault();

            var id = $(this).attr('id');
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            Swal.fire({
                title: `Você tem certeza que deseja apagar esse sorteio do dia ${dd}/${mm}/${yyyy}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#5cb85c',
                confirmButtonText: `Sim`,
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.forms['apagar_sorteio'].submit();
                }
            })
        })
    </script>

@stop
