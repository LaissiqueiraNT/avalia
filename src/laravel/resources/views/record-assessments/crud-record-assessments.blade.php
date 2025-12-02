@extends('adminlte::page')

@section('title', 'Registrar Avaliações')
@vite(['resources/css/appcustom.css'])
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            background: var(--medium-dark);
            margin: 0 auto;
            border-radius: 25px;
            width: 70%;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            height: auto;
        }

        .assessment-inner-card {
            background: var(--more-dark);
            border-radius: 20px;
            width: 90%;
            padding: 30px;
            margin: 0 auto;
            height: auto;
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
        input[type="date"],
        input[type="number"] {
            background: var(--low-dark);
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
            background: var(--primary-green);
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
            align-self: flex-end;
        }

        .btn-register:hover {
            background: #17a589;
        }

        .back-arrow {
            color: #fff;
            font-size: 22px;
            margin-bottom: 15px;
            display: inline-block;
            text-decoration: none;
        }

        .back-arrow:hover {
            color: var(--primary-green);
        }
    </style>
@endsection

@section('content')
    <div class="assessment-main-card">
        <a href="{{ route('record-assessments.index') }}" class="back-arrow">
            <i class="fas fa-arrow-left"></i>
        </a>


        <h2 class="assessment-title">Registrar Avaliações</h2>

        <div class="assessment-inner-card">
            <form
                action="{{ isset($edit) ? route('record-assessments.update', $edit->id) : route('record-assessments.store') }}"
                method="POST">
                @csrf
                @if (isset($edit))
                    @method('PUT')
                @endif
                <div class="assessment-row">
                    <div class="assessment-field">
                        <label>Tipo de prova:</label>
                        <select name="type_test">
                            <option value="">Selecione</option>
                            @foreach ($testTypes as $key => $label)
                                <option value="{{ $key }}" @selected(old('type_test', $edit->type_test ?? '') == $key)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>


                    </div>
                </div>
                <div class="assessment-row">
                    <div class="assessment-field">
                        <label>Matéria:</label>
                        <select name="discipline_id">
                            <option value="">Selecione</option>
                            @foreach ($disciplines as $d)
                                <option value="{{ $d->id }}" @selected(old('discipline_id', $edit->discipline_id ?? '') == $d->id)>
                                    {{ $d->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="assessment-row">
                    <div class="assessment-field">
                        <label>Data Início:</label>
                        <input type="date" name="primary_date"
       value="{{ old('primary_date', $edit->primary_date ?? '') }}">

                    </div>

                    <div class="assessment-field">
                        <label>Data Final:</label>
                        <input type="date" name="end_date"
       value="{{ old('end_date', $edit->end_date ?? '') }}">

                    </div>
                </div>
                <div class="assessment-row">
                    <div class="assessment-field">
                        <label>Duração da Prova (horas):</label>
                        <input type="number" name="hours" min="1" max="8" 
                               value="{{ old('hours', $edit->hours ?? '') }}"
                               placeholder="Ex: 2">
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; width: 100%;">
                    <button class="btn-register">Registrar</button>
                </div>
                @if ($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Campos obrigatórios faltando',
                            html: `{!! implode('<br>', $errors->all()) !!}`,
                            confirmButtonColor: '#0FAB93',
                            background: '#12151f',
                            color: '#fff',
                        });
                    </script>
                @endif

            </form>
        </div>
    </div>

@endsection
