{{-- resources/views/vendor/adminlte/auth/passwords/reset.blade.php --}}
@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@extends('layouts.reset')

@section('auth_header', __('Resetar senha'))

@section('auth_body')
    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

        {{-- Email --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-mail"
                   value="{{ old('email') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        {{-- Botão --}}
        <button type="submit" class="btn btn-primary btn-block">
            <i class="fas fa-sync-alt mr-1"></i> {{ __('Redefinir senha') }}
        </button>
    </form>
@endsection

@section('auth_footer')
    <p class="my-2 text-center">
        <a href="{{ route('auth-academic') }}">Voltar ao login</a>
    </p>
@endsection
