@extends('adminlte::page')

@section('title', 'Resultado da Prova')

@section('content_header')
    <h1 style="color: #fff;"></h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card" style="background: var(--medium-dark); border: 2px solid #0FAB93; border-radius: 15px; overflow: hidden;">
                <div class="card-header" style="background: #0FAB93; color: #fff; padding: 20px;">
                    <h4 class="mb-0" style="color: #fff; font-weight: 600;">
                        <i class="fas fa-clipboard-check"></i> 
                        {{ $scheduling->discipline->name }}
                    </h4>
                </div>
                <div class="card-body text-center" style="background: var(--low-dark); padding: 30px;">
                    
                    @php
                        $percentage = ($result->score / 10) * 100;
                        $approved = $result->score >= 6;
                    @endphp

                    <!-- Nota -->
                    <div class="mb-3">
                        <div class="score-number" style="color: {{ $approved ? '#0FAB93' : '#dc3545' }}; font-size: 60px; font-weight: bold;">
                            {{ number_format($result->score, 1) }}
                        </div>
                        <div style="color: #aaa; font-size: 14px;">de 10.0 pontos</div>
                    </div>

                    <!-- Barra de progresso -->
                    <div class="progress mb-3" style="height: 30px; background: rgba(255,255,255,0.1); border-radius: 15px;">
                        <div class="progress-bar" 
                             style="width: {{ $percentage }}%; font-size: 16px; font-weight: bold; background: {{ $approved ? '#0FAB93' : '#dc3545' }};">
                            {{ number_format($percentage, 0) }}%
                        </div>
                    </div>

                    <!-- Status -->
                    @if($approved)
                    <div class="alert mb-3" style="background: rgba(15, 171, 147, 0.15); border: 1px solid #0FAB93; border-radius: 10px; padding: 15px;">
                        <i class="fas fa-check-circle" style="color: #0FAB93; font-size: 24px;"></i>
                        <div style="color: #0FAB93; font-weight: 600; font-size: 18px; margin-top: 5px;">Aprovado!</div>
                        <div style="color: #fff; font-size: 14px;">Parabéns! 🎉</div>
                    </div>
                    @else
                    <div class="alert mb-3" style="background: rgba(220, 53, 69, 0.15); border: 1px solid #dc3545; border-radius: 10px; padding: 15px;">
                        <i class="fas fa-times-circle" style="color: #dc3545; font-size: 24px;"></i>
                        <div style="color: #dc3545; font-weight: 600; font-size: 18px; margin-top: 5px;">Reprovado</div>
                        <div style="color: #fff; font-size: 14px;">Nota mínima: 6.0</div>
                    </div>
                    @endif

                    <!-- Informações -->
                    <div class="row">
                        <div class="col-6">
                            <div style="background: rgba(15, 171, 147, 0.1); border: 1px solid rgba(15, 171, 147, 0.3); border-radius: 10px; padding: 15px;">
                                <i class="fas fa-calendar" style="color: #0FAB93; font-size: 20px;"></i>
                                <div style="color: #aaa; font-size: 12px; margin-top: 5px;">Data da Prova</div>
                                <div style="color: #fff; font-size: 14px; font-weight: 600;">{{ \Carbon\Carbon::parse($scheduling->scheduling)->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background: rgba(15, 171, 147, 0.1); border: 1px solid rgba(15, 171, 147, 0.3); border-radius: 10px; padding: 15px;">
                                <i class="fas fa-clock" style="color: #0FAB93; font-size: 20px;"></i>
                                <div style="color: #aaa; font-size: 12px; margin-top: 5px;">Enviada em</div>
                                <div style="color: #fff; font-size: 14px; font-weight: 600;">{{ \Carbon\Carbon::parse($result->created_at)->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Botão voltar -->
                    <div class="mt-4">
                        <a href="{{ route('student.assessments.index') }}" class="btn" style="background: #0FAB93; color: #fff; border: none; padding: 12px 30px; border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --backgroud-dashboard: #0d0f14;
        --more-dark: #12151f;
        --medium-dark: #181d2b;
        --low-dark: #1e2333;
        --primary-green: #0FAB93;
    }

    body {
        background: var(--backgroud-dashboard) !important;
        font-family: 'Poppins', sans-serif;
    }

    .content-wrapper {
        background: var(--backgroud-dashboard) !important;
    }

    .btn:hover {
        background: #17a589 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(15, 171, 147, 0.4) !important;
    }
</style>
@stop

@section('js')
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Prova Enviada!',
        text: 'Sua prova foi enviada com sucesso.',
        confirmButtonColor: '#0FAB93',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif
@stop
