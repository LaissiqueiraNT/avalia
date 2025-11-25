@extends('adminlte::page')

@section('title', 'Dashboard Customizado')

{{-- HEADER / NAVBAR --}}
@vite(['resources/css/appcustom.css'])
@section('content_top_nav_left')
    {{-- Lado esquerdo do navbar --}}
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            {{-- <input class="form-control form-control-navbar" type="search" placeholder="Buscar..." aria-label="Search"> --}}
            {{-- <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div> --}}
        </div>
    </form>
@stop
{{-- CONTEÚDO PRINCIPAL --}}
@section('content')
    <div class="p-3">
        <h2 style="color:white;">Dashboard Custom</h2>
        <p style="color:#ffffff;">Aqui vai o conteúdo principal do painel 🧩</p>
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
    </style>
@stop
