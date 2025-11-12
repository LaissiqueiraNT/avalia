@extends('layouts.auth-academic')

@section('content')
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('img/login.png') }}" alt="Logo 1">
        </div>
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/appcustom.css'])
        <h2 class="title">Login - Aluno</h2>

        @if (old('ra') !== null || old('password') !== null)
            <div class="alert alert-danger">
                <h1>teste</h1>
            </div>
        @endif


        <form method="POST" action="{{ route('auth-academic.login') }}">
            @csrf

            <div class="form-group">
                <input type="text" id="ra" name="ra" value="{{ old('ra') }}" placeholder="Digite seu RA"
                    required autofocus>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                <div class="links" style="text-align: left; margin-top: 8px;">
                    <a href="{{ route('password.request') }}">Esqueci a senha</a>
                </div>
            </div>

            <button type="submit" class="btn-login">Entrar</button>
        </form>

        <div class="links">
            <a class="auth" href="{{ route('login') }}">Acesso para Responsáveis</a>
        </div>
    </div>
@endsection
