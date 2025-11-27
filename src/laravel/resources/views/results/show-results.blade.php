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

    

   

</div>



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
