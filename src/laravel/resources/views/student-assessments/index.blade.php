@extends('adminlte::page')

@section('title', 'Minhas Avaliações')
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

        .assessment-main-card {
            background: var(--medium-dark);
            margin: 0 auto 30px;
            border-radius: 25px;
            width: 90%;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        .assessment-title {
            color: #fff;
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .section-title {
            color: var(--primary-green);
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid var(--primary-green);
            padding-bottom: 10px;
        }

        .assessment-card {
            background: var(--more-dark);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            border: 1px solid var(--primary-green);
            transition: 0.3s;
        }

        .assessment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(15, 171, 147, 0.3);
        }

        .assessment-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            color: #aaa;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .info-value {
            color: #fff;
            font-size: 16px;
            font-weight: 600;
        }

        .badge-type {
            background: var(--primary-green);
            color: #fff;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-schedule {
            background: var(--primary-green);
            padding: 10px 20px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-schedule:hover {
            background: #17a589;
            color: #fff;
        }

        .btn-cancel {
            background: #e74c3c;
            padding: 8px 16px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-cancel:hover {
            background: #c0392b;
            color: #fff;
        }

        .btn-do-exam {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 10px 20px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-do-exam:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
            color: #fff;
            text-decoration: none;
        }

        .btn-view-result {
            background: #28a745;
            padding: 10px 20px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-view-result:hover {
            background: #218838;
            color: #fff;
            text-decoration: none;
        }

        .no-assessments {
            text-align: center;
            color: #aaa;
            padding: 40px;
            font-size: 16px;
        }

        .scheduled-badge {
            background: #3498db;
            color: #fff;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .date-badge {
            background: var(--medium-dark);
            color: var(--primary-green);
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <div class="assessment-main-card">
        <h2 class="assessment-title">Minhas Avaliações</h2>

        <!-- Avaliações Disponíveis para Agendar -->
        <div class="mb-5">
            <h3 class="section-title">Avaliações Disponíveis</h3>

            @if ($availableAssessments->count() > 0)
                @foreach ($availableAssessments as $assessment)
                    <div class="assessment-card">
                        <div class="assessment-info">
                            <div class="info-item">
                                <span class="info-label">Disciplina</span>
                                <span class="info-value">{{ $assessment->discipline->name }}</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Tipo de Avaliação</span>
                                <span
                                    class="badge-type">{{ $assessment::TEST_TYPES[$assessment->type_test] ?? 'Prova' }}</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Período de Agendamento</span>
                                <span class="date-badge">
                                    {{ \Carbon\Carbon::parse($assessment->primary_date)->format('d/m/Y') }}
                                    até
                                    {{ \Carbon\Carbon::parse($assessment->end_date)->format('d/m/Y') }}
                                </span>
                            </div>

                            <div class="info-item">
                                <a href="{{ route('student.assessments.schedule', $assessment->id) }}" class="btn-schedule">
                                    Agendar Prova
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-assessments">
                    Não há avaliações disponíveis no momento.
                </div>
            @endif
        </div>

        <!-- Meus Agendamentos -->
        <div>
            <h3 class="section-title">Meus Agendamentos</h3>

            @if ($mySchedulings->count() > 0)
                @foreach ($mySchedulings as $scheduling)
                    @php
                        // Verificar se o agendamento tem avaliação vinculada
                        if (!$scheduling->assessment) {
                            continue; // Pular agendamentos sem avaliação
                        }

                        // Verificar pelo scheduling_id específico
                        $hasResult = DB::table('disc_sched')
                            ->where('scheduling_id', $scheduling->id)
                            ->where('user_id', auth()->id())
                            ->whereNotNull('score')
                            ->exists();
                    @endphp

                    <div class="assessment-card">
                        <div class="assessment-info">
                            <div class="info-item">
                                <span class="info-label">Disciplina</span>
                                <span class="info-value">{{ $scheduling->discipline->name }}</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Data da Prova</span>
                                <span class="scheduled-badge">
                                    {{ \Carbon\Carbon::parse($scheduling->scheduling)->format('d/m/Y H:i') }}
                                </span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Status</span>

                                @php
                                    $now = \Carbon\Carbon::now();
                                    $scheduledDate = \Carbon\Carbon::parse($scheduling->scheduling);
                                @endphp

                                <span class="info-value">
                                    @if ($hasResult)
                                        <span style="color: #28a745; font-size: 16px; font-weight: 600;">
                                            ✓ Prova Realizada
                                        </span>
                                    @else
                                        @if ($now->lt($scheduledDate))
                                            <span style="color: #f39c12; font-size: 16px; font-weight: 600;">
                                                ⏳ Aguarde — disponível em {{ $scheduledDate->format('d/m/Y H:i') }}
                                            </span>
                                        @else
                                            <span style="color: #00d9a3; font-size: 16px; font-weight: 600;">
                                                📝 Prova Disponível para Realizar
                                            </span>
                                        @endif
                                    @endif
                                </span>
                            </div>


                            <div class="info-item">
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $scheduledDate = \Carbon\Carbon::parse($scheduling->scheduling);
                                @endphp

                                @if ($hasResult)
                                    <a href="{{ route('student.exam.result', $scheduling->id) }}" class="btn-view-result">
                                        <i class="fas fa-eye"></i> Ver Resultado
                                    </a>
                                @else
                                    @if ($now->gte($scheduledDate))
                                        {{-- Liberar prova --}}
                                        <a href="{{ route('student.exam.show', $scheduling->id) }}" class="btn-do-exam">
                                            <i class="fas fa-pencil-alt"></i> Fazer Prova
                                        </a>
                                   
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-assessments">
                    Você ainda não possui agendamentos.
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('alert'))
        <script>
            Swal.fire({
                icon: '{{ session('alert.icon') }}',
                title: '{{ session('alert.title') }}',
                text: '{{ session('alert.text') ?? '' }}',
                confirmButtonColor: '#0FAB93',
                background: '#12151f',
                color: '#fff',
            });
        </script>
    @endif
@endsection
