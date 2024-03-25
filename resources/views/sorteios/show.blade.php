@extends('adminlte::page')

@section('title', 'Ver um Sorteio')

@section('content_header')
    <h1>Dashboard</h1>
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
                            <th>Departamento_Id</th>
                            <th>Status</th>
                            <th>Data</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="35%">{{ $sorteio->departamento_id }}</td>
                            <td>{{ $sorteio->status }}</td>
                            <td>{{ $sorteio->created_at->format('d/m/Y H:m') }}</td>
                            <td> <a href="{{ route('sorteios.edit', $sorteio->id) }}" class="fas fa-edit"></a> &nbsp;
                                <form name="apagar_sorteio" action={{ route('excluir_sorteio', $sorteio->id) }}
                                    method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $sorteio->id }}" name="sorteio_id">
                                    <a href="#" type="button" id="{{ $sorteio->id }}" class="sorteio_apagar"><i
                                            class="fas fa-backspace"></i></a>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
@stop

@section('js')
<form name="apagar_sorteio" action={{ route('excluir_sorteio', $sorteio->id) }}
    method="POST">
    @csrf
    <input type="hidden" value="{{ $sorteio->id }}" name="sorteio_id">
    <a href="#" type="button" id="{{ $sorteio->id }}" class="sorteio_apagar"><i
            class="fas fa-backspace"></i></a>
</form><form name="apagar_sorteio" action={{ route('excluir_sorteio', $sorteio->id) }}
                                    method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $sorteio->id }}" name="sorteio_id">
                                    <a href="#" type="button" id="{{ $sorteio->id }}" class="sorteio_apagar"><i
                                            class="fas fa-backspace"></i></a>
                                </form>

    <script>
        $('.sorteio_apagar').click(function(e) {
            e.preventDefault();

            var id = $(this).attr('id');

            Swal.fire({
                title: `Você tem certeza que deseja apagar esse sorteio do dia {{ $sorteio->created_at->format('d/m/Y') }}?`,
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
