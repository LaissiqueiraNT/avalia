@extends('adminlte::page')

@section('title', 'Visualizar Notas')

@section('content_header')
    <h1 style="color: #fff;">Visualizar Notas dos Alunos</h1>
@stop
@vite(['resources/css/appcustom.css'])
@section('content')
    <style>
        body,
        .content-wrapper,
        .main-footer {
            background: #1a252f !important;
            min-height: 100vh;
            color: #fff;
        }

        .dropdown-menu.show {
            background: var(--medium-dark) !important;
            border: 1px solid #333 !important;
            border-radius: 10px !important;
            padding: 10px 0 !important;
        }

        .dropdown-menu .dropdown-header,
        .user-header {
            background: var(--medium-dark) !important;
            color: #fff !important;
            border-radius: 10px 10px 0 0 !important;
        }

        .user-header p {
            color: #fff !important;
            font-weight: 600;
        }

        .dropdown-menu .dropdown-footer,
        .user-footer {
            background: var(--medium-dark) !important;
            padding: 10px !important;
            border-radius: 0 0 10px 10px !important;
        }

        .dropdown-menu .dropdown-footer a,
        .user-footer .btn-default {
            background: var(--more-dark) !important;
            color: #fff !important;
            font-weight: 600;
            text-align: center;
            border-radius: 8px;
            transition: 0.2s;
            border: none !important;
            width: 100%;
        }

        .dropdown-menu .dropdown-footer a:hover,
        .user-footer .btn-default:hover {
            background: #17a589 !important;
            color: #fff !important;
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

        .btn-create {
            background: var(--primary-green);
            padding: 10px 18px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-create:hover {
            background: #17a589;
        }


        .assessment-main-card {
            background: var(--medium-dark);
            margin: 0 auto;
            border-radius: 25px;
            width: 80%;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        .assessment-title {
            color: #fff;
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #fff;
        }

        table thead tr {
            background: var(--primary-green);
            color: #fff;
        }

        table thead th {
            padding: 12px;
            font-weight: 600;
            text-align: left;
        }

        table tbody tr {
            background: var(--low-dark);
            border-bottom: 1px solid var(--more-dark);
        }

        table tbody tr td {
            padding: 12px;
        }

        table tbody tr:hover {
            background: var(--medium-dark);
        }

        .btn-actions {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            color: var(--primary-green);
            font-weight: 500;
        }

        .btn-edit:hover {
            color: var(--secundary-green);
        }

        .btn-delete {
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            color: #c0392b;
            font-weight: 500;
        }

        .btn-delete:hover {
            color: #b43527;
        }
    </style>
    <div class="container-fluid">
        <div class="card" style="background: #2c3e50; border: none; border-radius: 15px;">
            <div class="card-header text-center" style="background: transparent; border: none; padding: 30px;">
                <h2 style="color: #fff; font-weight: 600; margin: 0;">Selecione uma Disciplina</h2>
            </div>
            <div class="card-body" style="padding: 30px;">
                @if ($disciplines->count() > 0)
                    <div class="row">
                        @foreach ($disciplines as $discipline)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <a href="{{ route('grades.show', $discipline->id) }}" style="text-decoration: none;">
                                    <div class="card h-100"
                                        style="background: #34495e; border: 1px solid #0FAB93; transition: 0.3s; border-radius: 10px;">
                                        <div class="card-body text-center" style="padding: 30px;">
                                            <i class="fas fa-book-open fa-3x mb-3" style="color: #0FAB93;"></i>
                                            <h5 style="color: #fff; font-weight: 600; margin-bottom: 10px;">
                                                {{ $discipline->name }}</h5>
                                            <p style="color: #aaa; margin: 0; font-size: 14px;">
                                                <i class="fas fa-users"></i> Ver notas dos alunos
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x mb-3" style="color: #666;"></i>
                        <p style="color: #999; font-size: 16px;">Nenhuma disciplina com avaliações registradas.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(15, 171, 147, 0.4);
        }
    </style>
@stop
