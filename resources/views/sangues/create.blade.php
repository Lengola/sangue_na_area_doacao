@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>➕ Registrar Nova Bolsa de Sangue</h2>

    <form action="{{ route('sangues.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Código da Bolsa</label>
                <input type="text" name="codigo_bolsa" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Tipo Sanguíneo</label>
                <select name="tipo_sanguineo" class="form-control" required>
                    <option value="">Selecione...</option>
                    @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $tipo)
                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Volume (ml)</label>
                <input type="number" name="volume_ml" class="form-control" min="200" max="600">
            </div>

            <div class="col-md-4 mb-3">
                <label>Centro de Saúde</label>
                <select name="centro_id" class="form-control" required>
                    <option value="">Selecione...</option>
                    @foreach($centros as $centro)
                        <option value="{{ $centro->id }}">{{ $centro->nome_centro }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Data de Coleta</label>
                <input type="date" name="data_coleta" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Data de Validade</label>
                <input type="date" name="data_validade" class="form-control">
            </div>

            <div class="col-md-12 mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    @foreach(['quarentena','disponivel','reservada','emitida','transfundida','expirada','descarte'] as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('sangues.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </form>
</div>
@endsection
