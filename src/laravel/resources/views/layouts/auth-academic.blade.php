<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('{{ asset('img/backgroud.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }


        /* Efeito de rede/conexões no fundo */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                repeating-linear-gradient(0deg, transparent, transparent 50px, rgba(255, 255, 255, .03) 50px, rgba(255, 255, 255, .03) 51px),
                repeating-linear-gradient(90deg, transparent, transparent 50px, rgba(255, 255, 255, .03) 50px, rgba(255, 255, 255, .03) 51px);
            opacity: 0.3;
        }

        .login-container {
            background: var(--more-dark);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 500px;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-container img {
            max-width: 200px;
            margin-bottom: 10px;
        }

        .title {
            color: #ffffff;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #94a3b8;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 90%;
            margin: 0 auto;
            /* 🔥 centraliza horizontalmente */
            display: block;
            /* garante que ocupe a linha inteira */
            padding: 12px 15px;
            background: var(--low-dark);
            border-radius: 8px;
            color: #ffffff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .btn-login {
            width: 90%;
            margin: 10px auto 0 auto;
            /* 🔥 centraliza e dá espaçamento em cima */
            display: block;
            padding: 12px;
            background: var(--primary-green);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .links {
            width: 90%;
            margin: 8px auto 0 auto;
            /* centraliza e dá espaçamento */
            text-align: right;
            /* deixa o texto alinhado à direita */
        }

        .links a {
            color: var(--primary-green);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;

        }

        .links a:hover {
            color: var(--primary-green);
        }

        .links .auth {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            margin-bottom: 15px;
        }



        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
