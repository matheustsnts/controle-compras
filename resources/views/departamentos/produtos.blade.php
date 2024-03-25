@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Produtos que tem no departamento de {{ $departamento->nome }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Atribuir produtos à {{ $departamento->nome }}
        </div>
        <div class="card-body">

            @if ($produto->isEmpty())
                Não há produtos disponiveis nesse departamento
                @canany(['nivel-1', 'nivel-2', 'nivel-3', 'nivel-4'])
                    <div class="text-center">
                        <a href="{{ route('produtos.create') }}" class="btn btn-primary">Criar Produto</a>
                    </div>
                @endcanany
            @else
                <form action="{{ route('insertDeptProdutos', $departamento->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Produtos</label>
                        @foreach ($produto as $produtos)
                            <div class="form-check">
                                <input type="checkbox" value="{{ $produtos->id }}" name="produtos[]"
                                    class="form-check-input">
                                <label class="form-check-label">{{ $produtos->nome }}</label>
                            </div>
                        @endforeach

                    </div>
                    @error('erro_produto')
                        <span class="cor">
                            <strong>{{ $message }}</strong>
                        </span>
                        <br>
                    @enderror

                    <button type="submit" class="btn btn-success">Inserir</button>
                    @canany(['nivel-1', 'nivel-2', 'nivel-3', 'nivel-4'])
                        <a href="{{ route('produtos.create') }}" class="btn btn-primary" type="button">Criar Produto</a>
                    @endcanany


                </form>
            @endif

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
    <script>
        console.log('Hi!');
    </script>

    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

    @if (session()->has('erro_produto'))
        <script>
            toastr.error(`{{ session('erro_produto') }}`)
        </script>
    @endif
@stop
