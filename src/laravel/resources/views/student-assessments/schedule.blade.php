@extends('adminlte::page')

@section('title', 'Agendar Avaliação')
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

        .schedule-form-card {
            background: var(--medium-dark);
            margin: 0 auto;
            border-radius: 25px;
            max-width: 700px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        .form-title {
            color: #fff;
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .assessment-details {
            background: var(--more-dark);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid var(--primary-green);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            color: #aaa;
            font-size: 14px;
        }

        .detail-value {
            color: #fff;
            font-weight: 600;
            font-size: 16px;
        }

        .badge-type {
            background: var(--primary-green);
            color: #fff;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group label {
            color: #fff;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            background: var(--more-dark);
            border: 1px solid var(--primary-green);
            color: #fff;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
        }

        .form-control:focus {
            background: var(--more-dark);
            color: #fff;
            border-color: var(--primary-green);
            box-shadow: 0 0 10px rgba(15, 171, 147, 0.3);
        }

        /* Estilo para input de time */
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        .btn-submit {
            background: var(--primary-green);
            padding: 12px 30px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: 0.2s;
            margin-top: 20px;
        }

        .btn-submit:hover {
            background: #17a589;
            transform: translateY(-2px);
        }

        .btn-back {
            background: #95a5a6;
            padding: 10px 20px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            display: inline-block;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            background: #7f8c8d;
            color: #fff;
        }

        .help-text {
            color: #aaa;
            font-size: 13px;
            margin-top: 8px;
        }

        .alert-info {
            background: rgba(52, 152, 219, 0.2);
            border: 1px solid #3498db;
            color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
    </style>
@endsection

@section('content')
    <div class="schedule-form-card">
        <a href="{{ route('student.assessments.index') }}" class="btn-back">
            ← Voltar
        </a>

        <h2 class="form-title">Agendar Avaliação</h2>

        <!-- Detalhes da Avaliação -->
        <div class="assessment-details">
            <div class="detail-row">
                <span class="detail-label">Disciplina:</span>
                <span class="detail-value">{{ $assessment->discipline->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tipo de Avaliação:</span>
                <span class="badge-type">{{ $assessment::TEST_TYPES[$assessment->type_test] }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Período de Agendamento:</span>
                <span class="detail-value">
                    {{ \Carbon\Carbon::parse($assessment->primary_date)->format('d/m/Y') }} 
                    até 
                    {{ \Carbon\Carbon::parse($assessment->end_date)->format('d/m/Y') }}
                </span>
            </div>
        </div>

        <div class="alert-info">
            <strong>Atenção:</strong> Escolha a data em que você deseja realizar a prova. A data deve estar dentro do período de agendamento informado acima.
        </div>

        <!-- Formulário de Agendamento -->
        <form action="{{ route('student.assessments.store') }}" method="POST" id="scheduleForm">
            @csrf
            <input type="hidden" name="record_assessment_id" value="{{ $assessment->id }}">

            <div class="form-group">
                <label for="scheduling_date">Data para Realizar a Prova *</label>
                <input type="date" 
                       class="form-control" 
                       id="scheduling_date" 
                       name="scheduling_date"
                       min="{{ $assessment->primary_date }}"
                       max="{{ $assessment->end_date }}"
                       required>
                <div class="help-text">
                    Selecione uma data entre {{ \Carbon\Carbon::parse($assessment->primary_date)->format('d/m/Y') }} 
                    e {{ \Carbon\Carbon::parse($assessment->end_date)->format('d/m/Y') }}
                </div>
            </div>

            <div class="form-group">
                <label for="scheduling_time">Horário para Realizar a Prova *</label>
                <input type="time" 
                       class="form-control" 
                       id="scheduling_time" 
                       name="scheduling_time"
                       required>
                <div class="help-text">
                    @php
                        $totalMinutes = $assessment->hours ?? 120;
                        $hours = floor($totalMinutes / 60);
                        $minutes = $totalMinutes % 60;
                        $duration = '';
                        if ($hours > 0) {
                            $duration .= $hours . 'h';
                        }
                        if ($minutes > 0) {
                            $duration .= ($hours > 0 ? ' e ' : '') . $minutes . 'min';
                        }
                    @endphp
                    A prova terá duração de {{ $duration ?: '2h' }}
                </div>
            </div>

            @error('scheduling_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn-submit">
                Confirmar Agendamento
            </button>
        </form>
    </div>
@endsection

@section('js')
    @if(session('alert'))
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('scheduleForm');

            form.addEventListener('submit', function(e) {
                const date = document.getElementById('scheduling_date').value;
                const time = document.getElementById('scheduling_time').value;

                if (!date || !time) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Atenção!',
                        text: 'Por favor, selecione a data e o horário para a prova.',
                        confirmButtonColor: '#0FAB93',
                        background: '#12151f',
                        color: '#fff',
                    });
                }
            });
        });
    </script>
@endsection
