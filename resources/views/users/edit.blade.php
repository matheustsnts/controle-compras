@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1 class="text-center">Usuários</h1>
@stop

@section('content')

    <form action="{{ route('alterar_user') }}" method="POST">
        @csrf
        @method('put')
        {{-- <label for="">Nome</label> <br>
        <input type="text" name="name" class="form-control @error('name') is-valid @enderror" value="{{ $user->name }}">
        <br>
        @if ($errors->has('name'))
            <p class="help-block">{{ $errors->first('name') }}</p>
        @endif
        <label for="">Email</label> <br>
        <input type="email" name="email" class="form-control @error('email') is-valid @enderror"
            value="{{ $user->email }}"> <br>
        @if ($errors->has('email'))
            <p class="help-block">{{ $errors->first('email') }}</p>
        @endif --}}
        <label for="">Senha atual</label> <br>
        <input type="password" name="current_password" class="form-control @error('password') is-invalid @enderror">
        @if ($errors->has('password'))
            <span class="cor"><strong>{{ $errors->first('current_password') }}</strong></span>
            <br>
        @endif
        <br>
        <label for="">Nova senha</label> <br>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @if ($errors->has('password'))
            <span class="cor"><strong>{{ $errors->first('password') }}</strong></span>
            <br>
        @endif
        <br>
        <label for="">Confirme sua senha</label> <br>
        <input type="password" name="password_confirmation"
            class="form-control @error('password_confirmation') is-invalid @enderror"> <br>
        @if ($errors->has('password_confirmation'))
            <span class="color"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
            <br>
        @endif
        <button class="btn btn-success sucesso" type="submit">Salvar</button>
        <a href="{{ route('users.show') }}" type="button" class="btn btn-primary">Voltar</a>
    </form>

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



    <script>
        function showPassword(icon_component, input_component) {
            icon_component.click(function() {
                var input_type = input_component.attr('type') == 'password' ? 'text' : 'password';
                input_component.attr('type', input_type);
                // icon_component.text()=="exibir" ? icon_component.text("esconder") : icon_component.text("exibir");
                icon_component.hasClass('fas fa-eye') ? icon_component.removeClass('fas fa-eye').addClass(
                    'fas fa-eye-slash') : icon_component.removeClass('fas fa-eye-slash').addClass('fas fa-eye');
            })
        }

        $(document).ready(function() {
            var icon = $('#icon-mostrar-senha');
            var input = $('#input-senha');
            showPassword(icon, input)
        })
    </script>
@endsection
