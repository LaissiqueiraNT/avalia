@extends('adminlte::page')

@section('title', 'Agendar Prova')
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

    .modal-card {
        width: 450px;
        margin: 40px auto;
        background: var(--medium-dark);
        padding: 35px;
        border-radius: 25px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
    }

    input, select {
        background: var(--low-dark);
        border: none;
        color: #fff;
        width: 100%;
        padding: 10px;
        border-radius: 8px;
    }

    .btn-save {
        background: var(--primary-green);
        border: none;
        padding: 12px 15px;
        width: 100%;
        border-radius: 8px;
        margin-top: 20px;
    }
</style>
@endsection

@section('content')

<div class="modal-card">

    <h2 style="text-align:center; margin-bottom:20px;">
        {{ $assessment->discipline->name }}  
        ({{ \Carbon\Carbon::parse($assessment->primary_date)->format('d/m') }} -
         {{ \Carbon\Carbon::parse($assessment->end_date)->format('d/m') }})
    </h2>

    <form action="{{ route('student.scheduling.store') }}" method="POST">
        @csrf

        <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">

        <label>Selecione a data:</label>
        <input type="date" name="scheduling">

        <label style="margin-top:15px;">Endereço:</label>
        <input type="text" name="address" placeholder="Ex: Rua X, Nº 123">

        <label style="margin-top:15px;">Bairro:</label>
        <input type="text" name="neighborhood" placeholder="Ex: Centro">

        <button class="btn-save">Agendar</button>
    </form>

</div>

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Algumas informações estão faltando',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#0FAB93',
            background: '#12151f',
            color: '#fff',
        });
    </script>
@endif

@if (session('alert'))
<script>
    Swal.fire({
        icon: "{{ session('alert')['icon'] }}",
        title: "{{ session('alert')['title'] }}",
        confirmButtonColor: '#0FAB93',
        background: '#12151f',
        color: '#fff',
    });
</script>
@endif

@endsection
