@extends('adminlte::page')

@section('title', 'Notas - ' . $discipline->name)

@section('content_header')
    <h1 style="color: #fff;">Notas - {{ $discipline->name }}</h1>
@stop

@section('content')
    @vite(['resources/css/appcustom.css'])
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
        <!-- Tabela de Notas -->
        <div class="card" style="background: #2c3e50; border: none; border-radius: 15px;">
            <div class="card-header" style="background: #0FAB93; color: #fff; border-radius: 15px 15px 0 0;">
                <h3 class="card-title" style="color: #fff;">
                    <i class="fas fa-list"></i> Notas dos Alunos
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light" style="font-size: 14px; margin-right: 10px;">
                        Total: {{ $statistics['total_students'] }} alunos
                    </span>
                    <span class="badge badge-light" style="font-size: 14px; margin-right: 10px;">
                        Média: {{ number_format($statistics['average_score'], 1) }}
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                @if ($grades->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: #0FAB93;">
                                <tr>
                                    <th style="color: #fff; border-color: #0FAB93;">Aluno</th>
                                    <th style="color: #fff; border-color: #0FAB93;">Data da Prova</th>
                                    <th style="color: #fff; border-color: #0FAB93; text-align: center;">Nota</th>
                                    <th style="color: #fff; border-color: #0FAB93; text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody style="background: #34495e;">
                                @foreach ($grades as $grade)
                                    <tr style="border-color: rgba(255, 255, 255, 0.1);">
                                        <td style="color: #fff; border-color: rgba(255, 255, 255, 0.1);">
                                            <i class="fas fa-user" style="color: #0FAB93;"></i>
                                            {{ $grade->student_name }}
                                        </td>
                                        <td style="color: #fff; border-color: rgba(255, 255, 255, 0.1);">
                                            {{ \Carbon\Carbon::parse($grade->exam_date)->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="border-color: rgba(255, 255, 255, 0.1); text-align: center;">
                                            <span
                                                style="
                                        background: #0FAB93;
                                        color: #fff;
                                        font-size: 18px;
                                        font-weight: bold;
                                        padding: 5px 15px;
                                        border-radius: 5px;
                                        display: inline-block;
                                    ">
                                                {{ number_format($grade->score, 1) }}
                                            </span>
                                        </td>
                                        <td style="border-color: rgba(255, 255, 255, 0.1); text-align: center;">
                                            @if ($grade->score >= 7)
                                                <span style="color: #0FAB93; font-weight: bold;">
                                                    <i class="fas fa-check-circle"></i> Aprovado
                                                </span>
                                            @else
                                                <span style="color: #e74c3c; font-weight: bold;">
                                                    <i class="fas fa-times-circle"></i> Reprovado
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-3x mb-3" style="color: #666;"></i>
                        <p style="color: #999;">Nenhuma nota registrada para esta disciplina.</p>
                    </div>
                @endif
            </div>
            <div class="card-footer"
                style="background: #2c3e50; border-top: 1px solid rgba(255,255,255,0.1); border-radius: 0 0 15px 15px;">
                <a href="{{ route('grades.index') }}" class="btn" style="background: #0FAB93; color: #fff;">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
@stop
