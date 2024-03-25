@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Departamentos</h1>
@stop

@section('content')
    {{-- @if ($departamento->isEmpty())
        <p><a href="{{ route('departamentos.create') }}" class="btn btn-info">Criar Departamento</a></p>
    @else
        <div class="text-center">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach ($departamento as $departamentos)
                            <div class="col-md-3">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h5>{{ $departamentos->nome }}</h5>
                                        <p>
                                            @foreach ($departamentos->produtos as $produto)
                                                <ul>
                                                    <li>{{ $produto->nome }}</li>
                                                </ul>
                                            @endforeach
                                        </p>
                                    </div>
                                    <p class="small-box">
                                        <a href="{{ route('departamentos.show', $departamentos->id) }}"
                                            class="small-box-footer"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('departamentos.produtos', $departamentos->id) }}"
                                            class="small-box-footer"><i class="fab fa-app-store-ios"></i></a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <p><a href="{{ route('departamentos.create') }}" class="btn btn-info">Criar Departamento</a></p>
    @endif --}}

    <div class="text-center">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-9">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h5>{{ $user_departamento->nome }}</h5>
                                <p>
                                    @foreach ($user_departamento->produtos as $produto)
                                        <ul>
                                            <li>{{ $produto->nome }}</li>
                                        </ul>
                                    @endforeach
                                </p>
                            </div>
                            <p class="small-box">
                                <a href="{{ route('departamentos.show', $user_departamento->id) }}" class="small-box-footer"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('departamentos.produtos', $user_departamento->id) }}"
                                    class="small-box-footer"><i class="fab fa-app-store-ios"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $('.aviso').on('click', function() {
            window.alert(`Não existe departamento disponivel aqui`)
        })
    </script>
@stop
