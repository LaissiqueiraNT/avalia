<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resetar senha- {{ config('app.name') }}</title>
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

    </style>
</head>

<body>
    @yield('content')
</body>

</html>
