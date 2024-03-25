@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1 class="text-center">Produtos</h1>
@stop

@section('content')

    @if (session('msg3'))
        <script>
            toastr.success(`{{ session('msg3') }}`)
        </script>
    @endif

    <div class="text-center">
        <div class="card">
            @if ($produto->isEmpty())
                <div class="card-body">
                    Não tem produtos disponiveis
                @else
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produtos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produto as $produtos)
                                <tr>
                                    <td width="60%">{{ $produtos->id }}</td>
                                    <td width="30%">{{ $produtos->nome }}</td>
                                    @canany(['nivel-1', 'nivel-2', 'nivel-3', 'nivel-4'])
                                        <td class="space">
                                            <a href="{{ route('produtos.edit', $produtos->id) }}" class="fas fa-edit"></a>
                                            &nbsp;&nbsp;

                                            {{-- <a href="{{ route('produtos.delete', $produtos->id) }}"
                                            class="fas fa-backspace"></a> --}}
                                            <form action="{{ route('produtos.deletar', $produtos->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $produtos->id }}" name="produto_id">
                                                <a href="#" type="button" id="{{ $produtos->id }}"
                                                    class="btn-exclusao"><i class="fas fa-backspace"></i></a>

                                            </form>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    {{ $produto->links('custom.pagination') }}
                </div>
        </div>
    </div>
    @endif

    @canany(['nivel-1', 'nivel-2', 'nivel-3','nivel-4'])
        <p><a href="{{ route('produtos.create') }}" class="btn btn-info">Criar Produto</a></p>
    @endcanany
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
                title: 'Você tem certeza que quer excluir esse produto?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#5cb85c',
                confirmButtonText: `Sim`,
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.forms[id].submit();
                }
            })
        })
    </script>

@stop
