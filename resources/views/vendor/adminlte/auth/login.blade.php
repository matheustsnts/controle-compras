@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))
@php($password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
    @php($password_reset_url = $password_reset_url ? route($password_reset_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
    @php($password_reset_url = $password_reset_url ? url($password_reset_url) : '')
@endif

@section('auth_header', __('Faça o login'))

@section('auth_body')
    <form action="{{ $login_url }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('E-mail') }}" autofocus>

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

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" id="input-senha"
                class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Senha') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <button type="button" id="icon-mostrar-senha" class="btn btn-default btn-xs fas fa-eye-slash"></button>
                    &nbsp;&nbsp;
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        {{ __('Lembrar-me') }}
                    </label>
                </div>
            </div>

            <div class="col-5">
                <button type=submit
                    class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('Entrar') }}
                </button>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')
    {{-- Password reset link --}}
    @if ($password_reset_url)
        <p class="my-0">
            <a href="{{ $password_reset_url }}">
                {{ __('Esqueci minha senha') }}
            </a>
        </p>
    @endif

    {{-- Register link --}}
    @if ($register_url)
        <p class="my-0">
            <a href="{{ $register_url }}">
                {{ __('Fazer o cadastro') }}
            </a>
        </p>
    @endif
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

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

    @if (session()->has('apagado'))
        <script>
            toastr.success(`{{ session('apagado') }}`)
        </script>
    @endif
@endsection
