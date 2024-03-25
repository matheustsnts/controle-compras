@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Adicionar alguns usuários para ser administrador do site</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            Atribuir ADM aos usuários de {{ $departamento->nome }}
        </div>
        <div class="card-body">
            <form action="{{ route('adm_user_request') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Usuários</label>
                    @foreach ($departamento->users as $users)
                        @if ($users->admin == false)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $users->id }}" name="users[]">
                                <label class="form-check-label">{{ $users->name }}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="submit" class="btn btn-success">Inserir</button>
            </form>
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
