@extends('adminlte::page')

@section('title', 'Realizar Prova')
@vite(['resources/css/appcustom.css'])
@section('content_header')
    <h1 style="color: #fff;">Realizar Prova - {{ $scheduling->discipline->name }}</h1>
@stop

@section('content')
<div class="card" style="background: var(--medium-dark); border: 1px solid #0FAB93;">
    <div class="card-header" style="background: #0FAB93; color: #fff;">
        <h3 class="card-title mb-0" style="color: #fff;">
            <i class="fas fa-clipboard-check"></i> 
            Prova de {{ $scheduling->discipline->name }}
        </h3>
    </div>
    <div class="card-body" style="background: var(--low-dark);">
        <div class="alert" style="background: rgba(15, 171, 147, 0.1); border: 1px solid #0FAB93; color: #fff;">
            <i class="fas fa-info-circle" style="color: #0FAB93;"></i>
            <strong>Instruções:</strong>
            <ul class="mb-0 mt-2">
                <li>Esta prova contém 10 questões de múltipla escolha</li>
                <li>Cada questão tem 3 opções (A, B, C)</li>
                <li>Marque apenas uma alternativa por questão</li>
                <li>Após enviar, você não poderá refazer a prova</li>
                <li>Boa sorte!</li>
            </ul>
        </div>

        <form action="{{ route('student.exam.submit', $scheduling->id) }}" method="POST" id="examForm">
            @csrf
            
            @foreach($questions as $index => $question)
            <div class="question-card mb-4">
                <div class="card" style="background: var(--medium-dark); border: 1px solid #0FAB93;">
                    <div class="card-header" style="background: rgba(15, 171, 147, 0.2); border-bottom: 1px solid #0FAB93;">
                        <h5 class="mb-0" style="color: #fff;">
                            <i class="fas fa-question-circle" style="color: #0FAB93;"></i>
                            Questão {{ $index + 1 }}
                        </h5>
                    </div>
                    <div class="card-body" style="background: var(--low-dark);">
                        <p class="question-text mb-3" style="color: #fff;">{{ $question['question'] }}</p>
                        
                        <div class="form-group">
                            @foreach($question['responses'] as $response)
                            <div class="custom-control custom-radio mb-2">
                                <input 
                                    type="radio" 
                                    id="q{{ $question['id'] }}_r{{ $response->id }}" 
                                    name="answers[{{ $question['id'] }}]" 
                                    value="{{ $response->id }}"
                                    class="custom-control-input"
                                    required
                                >
                                <label class="custom-control-label" for="q{{ $question['id'] }}_r{{ $response->id }}">
                                    {{ $response->response }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="text-center mt-4">
                <button type="button" class="btn btn-lg" onclick="confirmSubmit()" style="background: #0FAB93; color: #fff; border: none;">
                    <i class="fas fa-paper-plane"></i> Enviar Prova
                </button>
                <a href="{{ route('student.assessments.index') }}" class="btn btn-lg btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        .nav-sidebar .nav-icon.fa-home {
            color: var(--primary-green);
        }


    .content-wrapper {
        background: var(--backgroud-dashboard) !important;
    }
    
    .question-card {
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .question-text {
        font-size: 1.1rem;
        font-weight: 500;
        color: #fff;
    }
    
    .custom-control-label {
        cursor: pointer;
        padding: 12px;
        border-radius: 6px;
        transition: all 0.3s;
        color: #fff !important;
        font-size: 1rem;
        line-height: 1.5;
        display: block;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .custom-control-input:checked ~ .custom-control-label {
        background: rgba(15, 171, 147, 0.2) !important;
        border: 2px solid #0FAB93 !important;
        font-weight: 600;
        color: #0FAB93 !important;
    }
    
    .custom-control-label:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(15, 171, 147, 0.5);
    }
    
    .custom-radio {
        margin-bottom: 12px;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    /* SweetAlert customização */
    .custom-swal {
        border-radius: 15px !important;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2) !important;
    }

    .btn-swal-success {
        background: #0FAB93 !important;
        border: none !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        font-size: 16px !important;
    }

    .btn-swal-success:hover {
        background: #17a589 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(15, 171, 147, 0.3) !important;
    }

    .btn-swal-primary {
        background: #0FAB93 !important;
        border: none !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
    }

    .btn-swal-danger {
        padding: 12px 30px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
    }

    .btn-swal-secondary {
        padding: 12px 30px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmSubmit() {
    // Verificar se todas as questões foram respondidas
    const totalQuestions = {{ count($questions) }};
    const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked').length;
    
    if (answeredQuestions < totalQuestions) {
        Swal.fire({
            icon: 'warning',
            title: 'Atenção!',
            html: `
                <p style="font-size: 16px; color: #333;">Você respondeu <strong>${answeredQuestions} de ${totalQuestions}</strong> questões.</p>
                <p style="font-size: 14px; color: #666;">Deseja enviar mesmo assim ou revisar suas respostas?</p>
            `,
            showCancelButton: true,
            confirmButtonText: 'Sim, enviar mesmo assim',
            cancelButtonText: 'Revisar minhas respostas',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#0FAB93',
            background: '#fff',
            customClass: {
                popup: 'custom-swal',
                confirmButton: 'btn-swal-danger',
                cancelButton: 'btn-swal-primary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                submitExam();
            }
        });
    } else {
        Swal.fire({
            icon: 'question',
            title: 'Confirmar Envio',
            html: `
                <div style="padding: 20px;">
                    <p style="font-size: 18px; color: #0FAB93; font-weight: 600; margin-bottom: 15px;">
                        ✓ Você respondeu todas as ${totalQuestions} questões!
                    </p>
                    <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 5px; margin: 20px 0;">
                        <p style="font-size: 15px; color: #856404; margin: 0;">
                            <strong>⚠️ Atenção:</strong> Após enviar, você não poderá refazer a prova!
                        </p>
                    </div>
                    <p style="font-size: 14px; color: #666; margin-top: 15px;">
                        Deseja enviar sua prova agora?
                    </p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Sim, enviar prova',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#0FAB93',
            cancelButtonColor: '#6c757d',
            background: '#fff',
            width: '600px',
            customClass: {
                popup: 'custom-swal',
                confirmButton: 'btn-swal-success',
                cancelButton: 'btn-swal-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                submitExam();
            }
        });
    }
}

function submitExam() {
    Swal.fire({
        title: 'Enviando prova...',
        text: 'Por favor, aguarde.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    document.getElementById('examForm').submit();
}
</script>
@stop
