@extends('adminlte::page')

@section('title', 'Notas - ' . $discipline->name)

@section('content_header')
    <h1 style="color: #fff;">Notas - {{ $discipline->name }}</h1>
@stop

@section('content')
<style>
    body, .content-wrapper, .main-footer {
        background: #1a252f !important;
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
            @if($grades->count() > 0)
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
                            @foreach($grades as $grade)
                            <tr style="border-color: rgba(255, 255, 255, 0.1);">
                                <td style="color: #fff; border-color: rgba(255, 255, 255, 0.1);">
                                    <i class="fas fa-user" style="color: #0FAB93;"></i>
                                    {{ $grade->student_name }}
                                </td>
                                <td style="color: #fff; border-color: rgba(255, 255, 255, 0.1);">
                                    {{ \Carbon\Carbon::parse($grade->exam_date)->format('d/m/Y H:i') }}
                                </td>
                                <td style="border-color: rgba(255, 255, 255, 0.1); text-align: center;">
                                    <span style="
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
                                    @if($grade->score >= 7)
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
        <div class="card-footer" style="background: #2c3e50; border-top: 1px solid rgba(255,255,255,0.1); border-radius: 0 0 15px 15px;">
            <a href="{{ route('grades.index') }}" class="btn" style="background: #0FAB93; color: #fff;">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
</div>
@stop
