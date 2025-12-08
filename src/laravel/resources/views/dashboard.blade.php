@extends('adminlte::page')

@section('title', 'Dashboard')

{{-- HEADER / NAVBAR --}}
@vite(['resources/css/appcustom.css'])
@section('content_top_nav_left')
@stop
{{-- CONTEÚDO PRINCIPAL --}}
@section('content')
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h2>Bem vindo Avalia - Professores</h2>
        </div>

        <!-- Cards de Estatísticas -->
        <div class="dashboard-card">
            <h3 class="dashboard-title">Dashboard</h3>
            
            <div class="stats-grid">
                <!-- Card: Avaliações Cadastradas -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Avaliações Cadastradas</div>
                        <div class="stat-value">{{ $totalAssessments ?? 0 }}</div>
                    </div>
                </div>

                <!-- Card: Alunos Inscritos -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Alunos Inscritos</div>
                        <div class="stat-value">{{ $totalStudents ?? 0 }}</div>
                    </div>
                </div>

                <!-- Card: Agendamentos Realizados -->
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Agendamentos Realizados</div>
                        <div class="stat-value">{{ $totalSchedulings ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <!-- Avaliações Recentes -->
            @if(isset($recentAssessments) && $recentAssessments->count() > 0)
                <div class="recent-section">
                    <h4 class="section-title">Avaliações Recentes</h4>
                    <div class="recent-list">
                        @foreach($recentAssessments as $assessment)
                            <div class="recent-item">
                                <div class="recent-info">
                                    <span class="recent-discipline">{{ $assessment->discipline->name }}</span>
                                    <span class="recent-type">{{ $assessment::TEST_TYPES[$assessment->type_test] }}</span>
                                </div>
                                <div class="recent-dates">
                                    <span class="recent-date">
                                        {{ \Carbon\Carbon::parse($assessment->primary_date)->format('d/m/Y') }} 
                                        até 
                                        {{ \Carbon\Carbon::parse($assessment->end_date)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

{{-- CSS CUSTOM --}}
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--more-dark);
            border-radius: 15px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            border: 1px solid rgba(15, 171, 147, 0.3);
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(15, 171, 147, 0.3);
            border-color: var(--primary-green);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            color: #aaa;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .stat-value {
            color: #fff;
            font-size: 32px;
            font-weight: 700;
        }

        .recent-section {
            margin-top: 30px;
        }

        .section-title {
            color: var(--primary-green);
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid var(--primary-green);
            padding-bottom: 10px;
        }

        .recent-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .recent-item {
            background: var(--more-dark);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.2s;
        }

        .recent-item:hover {
            border-color: var(--primary-green);
            transform: translateX(5px);
        }

        .recent-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .recent-discipline {
            color: #fff;
            font-size: 16px;
            font-weight: 600;
        }

        .recent-type {
            background: var(--primary-green);
            color: #fff;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 13px;
            font-weight: 600;
        }

        .recent-dates {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .recent-date {
            color: #aaa;
            font-size: 14px;
        }
    </style>
@stop
