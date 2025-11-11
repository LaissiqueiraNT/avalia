@extends('layouts.auth-academic')

@section('content')
<div class="login-container">
    <div class="logo-container">
        {{-- Adicione seus logos aqui --}}
        <img src="{{ asset('img/login.png') }}" alt="Logo 1">
        {{-- <img src="{{ asset('images/logo2.png') }}" alt="Logo 2"> --}}
    </div>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <h2 class="title">Login - Aluno</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            {{-- <label for="ra">RA/Aluno</label> --}}
            <input type="text" 
                   id="ra" 
                   name="ra" 
                   value="{{ old('ra') }}" 
                   placeholder="Digite seu RA"
                   required 
                   autofocus>
        </div>

        <div class="form-group">
            {{-- <label for="password">Senha</label> --}}
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
        <a class="auth" href="{{ route('login') }}">Acesso para Responsáveis</a>
    </div>
</div>
@endsection