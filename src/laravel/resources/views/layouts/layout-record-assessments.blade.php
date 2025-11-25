<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    /* Fundo geral turquesa */
    .content-wrapper {
        background: #08c4cc !important; 
        min-height: 100vh;
        padding-top: 40px;
    }

    /* Card principal */
    .crud-card {
        background: #1f2430;
        border-radius: 25px;
        width: 85%;
        margin: 0 auto;
        padding: 40px 50px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    }

    .crud-inner-card {
        background: #2a2f3a;
        padding: 40px;
        border-radius: 20px;
    }

    .crud-title {
        color: #ffffff;
        font-size: 28px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Labels */
    .crud-inner-card label {
        color: #d5d5d5;
        font-size: 15px;
        margin-bottom: 6px;
    }

    /* Inputs e selects */
    .crud-inner-card select,
    .crud-inner-card input {
        background: #272c36;
        border: none;
        color: #fff;
        height: 42px;
        border-radius: 10px;
        padding-left: 12px;
        outline: none;
    }

    .crud-row {
        display: flex;
        gap: 25px;
        margin-bottom: 25px;
    }

    .crud-field {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Botão */
    .crud-submit {
        background: #1abc9c;
        border: none;
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 600;
        float: right;
        transition: .2s;
    }

    .crud-submit:hover {
        background: #17a589;
    }
</style>
@yield('css')

</head>
 .content-wrapper {
        background: #08c4cc !important;
        min-height: 100vh;
        padding-top: 4
<body>
    @yield('content')
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/appcustom.css'])
</body>

</html>
