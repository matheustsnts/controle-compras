@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
@endif

@section('auth_header', __('Fazer o cadastro'))

@section('auth_body')



    <form action="{{ $register_url }}" method="post">
        @csrf


        @error('departamento_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" placeholder="{{ __('Nome Completo') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('E-mail') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Campo Selecionar Departamento --}}
        <div class="input-group mb-3">
            {{-- <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}"> --}}

            <div class="input-group mb-3">
                <select class="custom-select @error('departamento_id') is-invalid @enderror" name="departamento_id">
                    <option value="">Selecione um departamento</option>
                    @foreach ($departamentos as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>

            @if ($errors->has('departamento_id'))
                <p class="invalid-feedback"><strong>{{ $errors->first('departamento_id') }}</strong></p>
            @endif


        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" id="input-senha-1"
                class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Senha') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <button type="button" id="icon-mostrar-senha-1"
                        class="btn btn-default btn-xs fas fa-eye-slash"></button> &nbsp;&nbsp;
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" id="input-senha-2"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('Confirme sua senha') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <button type="button" id="icon-mostrar-senha-2"
                        class="btn btn-default btn-xs fas fa-eye-slash"></button> &nbsp;&nbsp;
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('Registrar') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('Eu já tenho conta') }}
        </a>
    </p>
@stop

@section('js')
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
            var icon_1 = $('#icon-mostrar-senha-1');
            var input_1 = $('#input-senha-1');
            var icon_2 = $('#icon-mostrar-senha-2');
            var input_2 = $('#input-senha-2');
            showPassword(icon_1, input_1)
            showPassword(icon_2, input_2)
        })
    </script>
@endsection
