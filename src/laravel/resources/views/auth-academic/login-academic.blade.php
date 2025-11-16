@extends('layouts.layouts-auth-academic')

@section('content')
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('img/login.png') }}" alt="Logo 1">
        </div>
        <h2 class="title">Login - Aluno</h2>
        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Credenciais inválidas',
                    text: 'Por favor, verifique seu RA e senha e tente novamente.',
                    confirmButtonColor: '#0FAB93',
                    background: '#12151f',
                    color: '#fff',
                });
            </script>
        @endif


        <form id="loginForm" method="POST" action="{{ route('auth-academic.login') }}">
            @csrf

            <div class="form-group">
                <input type="text" id="ra" name="ra" value="{{ old('ra') }}" placeholder="Digite seu RA"
                    autofocus>
            </div>

            <div class="form-group password-wrapper" style="position: relative;">
                <input type="password" id="password" name="password" placeholder="Digite sua senha">

                <img id="togglePasswordAcademic" src="{{ asset('img/hide.png') }}"
                    style="width: 22px; position: absolute; right: 30px; top: 50%; transform: translateY(-50%); cursor: pointer;">
            </div>

            <button type="submit" class="btn-login">Entrar</button>
        </form>


        <div class="links">
            <a class="auth" href="{{ route('login') }}">Acesso para Responsáveis</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');

            if (form) {
                form.addEventListener('submit', function(e) {
                    const ra = document.getElementById('ra').value.trim();
                    const password = document.getElementById('password').value.trim();

                    if (!ra || !password) {
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
            const togglePassword = document.getElementById('togglePasswordAcademic');

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
