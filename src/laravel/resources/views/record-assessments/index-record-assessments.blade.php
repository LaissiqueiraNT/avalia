@extends('adminlte::page')

@section('title', 'Avaliações Registradas')
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

        .nav-sidebar .nav-icon.fa-home {
            color: var(--primary-green);
        }

        .btn-create {
            background: var(--primary-green);
            padding: 10px 18px;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-create:hover {
            background: #17a589;
        }


        .assessment-main-card {
            background: var(--medium-dark);
            margin: 0 auto;
            border-radius: 25px;
            width: 80%;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        .assessment-title {
            color: #fff;
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #fff;
        }

        table thead tr {
            background: var(--primary-green);
            color: #fff;
        }

        table thead th {
            padding: 12px;
            font-weight: 600;
            text-align: left;
        }

        table tbody tr {
            background: var(--low-dark);
            border-bottom: 1px solid var(--more-dark);
        }

        table tbody tr td {
            padding: 12px;
        }

        table tbody tr:hover {
            background: var(--medium-dark);
        }

        .btn-actions {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            color: var(--primary-green);
            font-weight: 500;
        }

        .btn-edit:hover {
            color: var(--secundary-green);
        }

        .btn-delete {
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            color: #c0392b;
            font-weight: 500;
        }

        .btn-delete:hover {
            color: #b43527;
        }
    </style>
@endsection

@section('content')
    <div class="assessment-main-card">
        <h2 class="assessment-title">Avaliações Registradas</h2>
        <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <a href="{{ route('record-assessments.create') }}" class="btn-create">
                + Novo Registro
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Matéria</th>
                    <th>Data Início</th>
                    <th>Data Final</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($assessments as $a)
                    <tr>
                        <td>{{ $testTypes[$a->type_test] ?? '—' }}</td>
                        <td>{{ $a->discipline->name ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($a->primary_date)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($a->end_date)->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-actions">
                                <a href="{{ route('record-assessments.edit', $a->id) }}" class="btn-edit">Editar</a>

                                <form action="{{ route('record-assessments.destroy', $a->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
               <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Essa avaliação será removida.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0FAB93',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir',
                background: '#12151f',
                color: '#fff',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

            </tbody>
        </table>
    </div>
@endsection
