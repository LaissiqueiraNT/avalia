@extends('layouts.app')

@section('content')
<div class="crud-wrapper">
    <div class="crud-card">
        <h2 class="crud-title">Registrar Avaliações</h2>

        <div class="crud-inner-card">
            <form action="{{ route('avaliacoes.store') }}" method="POST">
                @csrf

                <div class="crud-row">
                    <div class="crud-field">
                        <label>Matéria:</label>
                        <select name="materia_id">
                            <option value="">Selecione</option>
                            @foreach($materias as $m)
                                <option value="{{ $m->id }}">{{ $m->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="crud-field">
                        <label>Polo:</label>
                        <select name="polo_id">
                            <option value="">Selecione</option>
                            @foreach($polos as $p)
                                <option value="{{ $p->id }}">{{ $p->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="crud-row">
                    <div class="crud-field">
                        <label>Data:</label>
                        <input type="date" name="data">
                    </div>
                </div>

                <button class="crud-submit">Registrar</button>
            </form>
        </div>
    </div>
</div>
<style>
    .crud-wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 40px 0;
}

.crud-card {
    background: #00b3ac; /* fundo turquesa igual print */
    width: 80%;
    max-width: 1100px;
    padding: 40px;
    border-radius: 20px;
}

.crud-title {
    text-align: center;
    color: #fff;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 25px;
}

.crud-inner-card {
    background: #0f111a; /* caixa interna */
    padding: 35px;
    border-radius: 20px;
    color: #fff;
}

.crud-row {
    display: flex;
    gap: 25px;
    margin-bottom: 25px;
}

.crud-field {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.crud-field label {
    margin-bottom: 5px;
    color: #ccc;
}

.crud-field select,
.crud-field input {
    background: #161a22;
    border: none;
    height: 40px;
    padding: 0 10px;
    color: #fff;
    border-radius: 10px;
    outline: none;
}

.crud-submit {
    margin-top: 10px;
    background: #0FAB93;
    border: none;
    padding: 12px 30px;
    color: white;
    font-weight: bold;
    border-radius: 10px;
    float: right;
    cursor: pointer;
    transition: .2s;
}

.crud-submit:hover {
    background: #0c8f7b;
}

@media (max-width: 768px) {
    .crud-row {
        flex-direction: column;
    }
}

</style>
@endsection
