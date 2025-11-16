@extends('layouts.layouts-auth')

@section('content')
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('img/login.png') }}" alt="Logo 1">
        </div>
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/appcustom.css'])
        <h2 class="title">Login - Responsável</h2>

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Credenciais inválidas',
                    text: 'Por favor, verifique seu Email e senha e tente novamente.',
                    confirmButtonColor: '#0FAB93',
                    background: '#12151f',
                    color: '#fff',
                });
            </script>
        @endif

        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Digite seu Email" autofocus>
            </div>

            <div class="form-group password-wrapper" style="position: relative;">
                <input type="password" id="password" name="password" placeholder="Digite sua senha">

                <img id="togglePassword" src="{{ asset('img/hide.png') }}"
                    style="width: 22px; position: absolute; right: 30px; top: 50%; transform: translateY(-50%); cursor: pointer;">
            </div>

            <button type="submit" class="btn-login">Entrar</button>
        </form>

        <div class="links">
            <a class="auth" href="{{ route('auth-academic') }}">Acesso para Alunos</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');

            if (form) {
                form.addEventListener('submit', function(e) {
                    const email = document.getElementById('email').value.trim();
                    const password = document.getElementById('password').value.trim();

                    if (!email || !password) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Atenção!',
                            text: 'Preencha todos os campos antes de entrar',
                            confirmButtonColor: '#0FAB93',
                            background: '#12151f',
                            color: '#fff',
                        });
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;

                this.src = type === 'password' ?
                    "{{ asset('img/hide.png') }}" :
                    "{{ asset('img/view.png') }}";
            });
        });
    </script>
@endsection
