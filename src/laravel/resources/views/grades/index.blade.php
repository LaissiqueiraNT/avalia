@extends('adminlte::page')

@section('title', 'Visualizar Notas')

@section('content_header')
    <h1 style="color: #fff;">Visualizar Notas dos Alunos</h1>
@stop

@section('content')
<style>
    body, .content-wrapper, .main-footer {
        background: #1a252f !important;
    }
</style>
<div class="container-fluid">
    <div class="card" style="background: #2c3e50; border: none; border-radius: 15px;">
        <div class="card-header text-center" style="background: transparent; border: none; padding: 30px;">
            <h2 style="color: #fff; font-weight: 600; margin: 0;">Selecione uma Disciplina</h2>
        </div>
        <div class="card-body" style="padding: 30px;">
            @if($disciplines->count() > 0)
                <div class="row">
                    @foreach($disciplines as $discipline)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <a href="{{ route('grades.show', $discipline->id) }}" style="text-decoration: none;">
                                <div class="card h-100" style="background: #34495e; border: 1px solid #0FAB93; transition: 0.3s; border-radius: 10px;">
                                    <div class="card-body text-center" style="padding: 30px;">
                                        <i class="fas fa-book-open fa-3x mb-3" style="color: #0FAB93;"></i>
                                        <h5 style="color: #fff; font-weight: 600; margin-bottom: 10px;">{{ $discipline->name }}</h5>
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
