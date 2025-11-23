@extends('adminlte::page')

@section('title', 'Registrar Avaliações')

@vite(['resources/css/appcustom.css'])

@section('content_top_nav_left')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
        </div>
    </form>
@stop

@section('content')
    <div class="container-fluid p-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                    <div class="card-header text-center" style="background: transparent; border: none; padding: 30px 0 20px 0;">
                        <h2 style="color: white; font-weight: 300; margin: 0; font-size: 2rem;">Registrar Avaliações</h2>
                    </div>
                    
                    <div class="card-body" style="padding: 40px;">
                        <!-- Mensagens de sucesso/erro -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%); border: none; color: white;">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); border: none; color: white;">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); border: none; color: white;">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form id="scheduling-form" action="{{ route('scheduling.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <!-- Matéria -->
                                <div class="col-md-6 mb-4">
                                    <label for="discipline_id" style="color: white; font-weight: 500; margin-bottom: 10px; display: block;">Matéria:</label>
                                    <select name="discipline_id" id="discipline_id" class="form-control custom-select" style="background: #1a252f; border: 1px solid #34495e; color: white; border-radius: 8px; padding: 12px 15px; font-size: 16px; width: 100%; min-height: 45px;" required>
                                        <option value="" style="background: #1a252f; color: white;">Selecione uma Matéria:</option>
                                        <option value="1" {{ old('discipline_id') == '1' ? 'selected' : '' }} style="background: #1a252f; color: white;">teste1</option>
                                        <option value="2" {{ old('discipline_id') == '2' ? 'selected' : '' }} style="background: #1a252f; color: white;">teste2</option>
                                        <option value="3" {{ old('discipline_id') == '3' ? 'selected' : '' }} style="background: #1a252f; color: white;">teste3</option>
                                        <option value="4" {{ old('discipline_id') == '4' ? 'selected' : '' }} style="background: #1a252f; color: white;">teste4</option>
                                        <option value="5" {{ old('discipline_id') == '5' ? 'selected' : '' }} style="background: #1a252f; color: white;">teste5</option>
                                        @foreach($disciplines as $discipline)
                                            <option value="{{ $discipline->id }}" {{ old('discipline_id') == $discipline->id ? 'selected' : '' }} style="background: #1a252f; color: white;">{{ $discipline->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Data -->
                                <div class="col-md-6 mb-4">
                                    <label for="date" style="color: white; font-weight: 500; margin-bottom: 10px; display: block;">Data:</label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" style="background: #1a252f; border: 1px solid #34495e; color: white; border-radius: 8px; padding: 12px; font-size: 16px;" required>
                                </div>
                            </div>

                            <!-- Botão de Registrar -->
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-success btn-lg" style="background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%); border: none; border-radius: 8px; padding: 12px 30px; font-weight: 500; font-size: 16px; box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3); transition: all 0.3s ease;">
                                        <i class="fas fa-save mr-2"></i>
                                        Registrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .content-wrapper {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            min-height: 100vh;
        }

        .custom-select:focus, 
        .form-control:focus {
            background: #1a252f !important;
            border-color: #3498db !important;
            color: white !important;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25) !important;
        }

        .custom-select option:checked {
            background: #3498db !important;
            color: white !important;
        }

        /* Ajustar tamanho dos selects para evitar corte de texto */
        .custom-select {
            width: 100% !important;
            min-width: 250px !important;
            overflow: visible !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
        }

        /* Garantir que as options apareçam corretamente */
        .custom-select option {
            padding: 8px 12px !important;
            white-space: normal !important;
            word-wrap: break-word !important;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }

        /* Customização dos inputs de data e hora */
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('js/scheduling.js') }}"></script>
@stop