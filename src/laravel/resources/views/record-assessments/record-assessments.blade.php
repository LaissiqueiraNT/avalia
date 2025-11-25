@extends('adminlte::page')

@section('title', 'Registrar Avaliações')
@vite(['resources/css/appcustom.css'])
@section('css')
    <style>
        body {
            background: var(--backgroud-dashboard);
            min-height: 100vh;
            color: #fff;
        }

        .main-header.navbar {
            background-color: var(--more-dark) !important;
            border-bottom: 1px solid var(--primary-green);
        }

        .main-sidebar {
            background-color: var(--more-dark) !important;
        }

        .nav-link {
            color: #fff;
        }

        .nav-link.active {
            background-color: var(--primary-green) !important;
            color: #fff !important;
        }

        .brand-link {
            background-color: var(--more-dark) !important;
        }

        .content-wrapper {
            background: var(--more-dark);
        }

        .nav-sidebar .nav-icon {
            color: #fff;
        }

        .nav-sidebar .nav-icon.fa-home {
            color: var(--primary-green);
        }

        .assessment-main-card {
            background: #1f2430;
            width: 85%;
            margin: 0 auto;
            border-radius: 25px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        .assessment-inner-card {
            background: #1b1e27;
            padding: 40px;
            border-radius: 20px;
            width: 75%;
            margin: 0 auto;
        }

        .assessment-title {
            color: #fff;
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
        }

        label {
            color: #ddd;
        }

        select,
        input[type="date"] {
            background: #272c36;
            border: none;
            color: #fff;
            height: 40px;
            padding-left: 10px;
            border-radius: 8px;
            outline: none;
            width: 100%;
        }

        .assessment-row {
            display: flex;
            gap: 35px;
            margin-bottom: 25px;
        }

        .assessment-field {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .btn-register {
            background: #1abc9c;
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            float: right;
        }

        .btn-register:hover {
            background: #17a589;
        }
    </style>
@endsection

@section('content')
    <div class="assessment-main-card">
        <h2 class="assessment-title">Registrar Avaliações</h2>

        <div class="assessment-inner-card">
            <form action="{{ route('record-assessments.store') }}" method="POST">
                @csrf

                <div class="assessment-row">
                    <div class="assessment-field">
                        <label>Matéria:</label>
                        <select name="discipline_id">
                            <option value="">Selecione</option>
                            @foreach ($disciplines as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="assessment-field">
                        <label>Data:</label>
                        <input type="date" name="date">
                    </div>
                </div>

                <div class="assessment-row">
                    <div class="assessment-field">
                        <label>Hora:</label>
                        <select name="time">
                            <option value="">Selecione</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="19:00">19:00</option>
                        </select>
                    </div>
                </div>

                <button class="btn-register">Registrar</button>
            </form>
        </div>
    </div>
@endsection
