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
</style>
@endsection

@section('content')
<div class="scheduling-list">

    @foreach ($avaliacoes as $a)
        <div class="scheduling-card">
            <h3 style="color:#fff">{{ $a->discipline->name }}</h3>
            <p><strong>Período:</strong>  
               {{ \Carbon\Carbon::parse($a->primary_date)->format('d/m') }} —
               {{ \Carbon\Carbon::parse($a->end_date)->format('d/m') }}
            </p>

            <a href="{{ route('student.scheduling.create', $a->id) }}">
                <button class="btn-schedule">Agendar prova</button>
            </a>
        </div>
    @endforeach

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
