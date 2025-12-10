@extends('adminlte::page')

@section('title', 'Início')

@vite(['resources/css/appcustom.css'])

@section('css')
    <style>
        body {
            background: var(--backgroud-dashboard);
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

        /* Dashboard Styles */
        .dashboard-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-header {
            background: var(--medium-dark);
            padding: 20px 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
        }

        .dashboard-header h2 {
            color: #fff;
            font-size: 24px;
            margin: 0;
            font-weight: 600;
        }

        .dashboard-card {
            background: var(--medium-dark);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        .dashboard-title {
            color: #fff;
            font-size: 26px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .exams-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .exam-item {
            background: var(--more-dark);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(15, 171, 147, 0.3);
            transition: 0.3s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .exam-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(15, 171, 147, 0.3);
            border-color: var(--primary-green);
        }

        .exam-info {
            flex: 1;
        }

        .exam-discipline {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .exam-datetime {
            color: var(--primary-green);
            font-size: 16px;
            font-weight: 600;
        }

        .exam-status {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-upcoming {
            background: rgba(15, 171, 147, 0.2);
            color: var(--primary-green);
        }

        .status-today {
            background: rgba(243, 156, 18, 0.2);
            color: #f39c12;
        }

        .status-past {
            background: rgba(149, 165, 166, 0.2);
            color: #95a5a6;
        }

        .no-exams {
            text-align: center;
            padding: 60px 20px;
            color: #aaa;
        }

        .no-exams i {
            font-size: 64px;
            margin-bottom: 20px;
            color: var(--primary-green);
        }

        .no-exams p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .no-exams a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }

        .no-exams a:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h2>Bem vindo AvaliA - Alunos</h2>
        </div>

        <!-- Card Principal -->
        <div class="dashboard-card">
            <h3 class="dashboard-title">Provas Agendadas</h3>

            @if ($mySchedulings->count() > 0)
                <div class="exams-list">
                    @foreach ($mySchedulings as $scheduling)
                        <div class="exam-item">
                            <div class="exam-info">
                                <div class="exam-discipline">{{ $scheduling->discipline->name }}</div>
                                <div class="exam-datetime">
                                    {{ \Carbon\Carbon::parse($scheduling->scheduling)->format('d/m - H:i') }}
                                </div>
                            </div>
                            <div>
                                @if (\Carbon\Carbon::parse($scheduling->scheduling)->isFuture())
                                    <span class="exam-status status-upcoming">Agendada</span>
                                @elseif(\Carbon\Carbon::parse($scheduling->scheduling)->isToday())
                                    <span class="exam-status status-today">Hoje</span>
                                @else
                                    <span class="exam-status status-past">Realizada</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-exams">
                    <i class="fas fa-calendar-times"></i>
                    <p>Você ainda não possui provas agendadas</p>
                    <p>
                        <a href="{{ route('student.assessments.index') }}">
                            Clique aqui para agendar sua primeira prova
                        </a>
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
