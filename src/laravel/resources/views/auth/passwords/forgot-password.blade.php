{{-- resources/views/auth-academic/forgot-password.blade.php --}}
@extends('layouts.layouts-auth-academic')

@section('content')
<div class="login-container">
    <div class="logo-container">
        <img src="{{ asset('img/login.png') }}" alt="Logo">
    </div>

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/appcustom.css'])

    <h2 class="title">Recuperar Senha</h2>

    {{-- Mensagens de erro ou sucesso --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="Digite seu e-mail cadastrado"
                required 
                autofocus>
        </div>

        <button type="submit" class="btn-login">
            Enviar código de redefinição
        </button>
    </form>

    <div class="links" style="margin-top: 15px;">
        <a class="auth" href="{{ route('auth-academic') }}">Voltar ao login</a>
    </div>
</div>
@endsection
