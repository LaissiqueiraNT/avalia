@extends('layouts.auth')

@section('content')
<div class="login-container">
    <div class="logo-container">
        {{-- Adicione seus logos aqui --}}
        <img src="{{ asset('img/login.png') }}" alt="Logo 1">
        {{-- <img src="{{ asset('images/logo2.png') }}" alt="Logo 2"> --}}
    </div>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/appcustom.css'])
    <h2 class="title">Login - Responsável</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('teste') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <input type="email" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="Digite seu Email"
                   required 
                   autofocus>
        </div>

        <div class="form-group">
            <input type="password" 
                   id="password" 
                   name="password" 
                   placeholder="Digite sua senha"
                   required>
            <div class="links" style="text-align: left; margin-top: 8px;">
                <a href="{{ route('password.request') }}">Esqueci a senha</a>
            </div>
        </div>

        <button type="submit" class="btn-login">Entrar</button>
    </form>

    <div class="links">
        <a class="auth" href="{{ route('auth-academic') }}">Acesso para Alunos</a>
    </div>
</div>
@endsection