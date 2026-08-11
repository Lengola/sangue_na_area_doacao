@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>✏️ Editar Bolsa #{{ $sangue->codigo_bolsa }}</h2>

    <form action="{{ route('sangues.update', $sangue->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Código da Bolsa</label>
                <input type="text" name="codigo_bolsa" value="{{ $sangue->codigo_bolsa }}" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Tipo Sanguíneo</label>
                <select name="tipo_sanguineo" class="form-control" required>
                    @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $tipo)
                        <option value="{{ $tipo }}" @selected($sangue->tipo_sanguineo == $tipo)>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Centro de Saúde</label>
                <select name="centro_id" class="form-control" required>
                    @foreach($centros as $centro)
                        <option value="{{ $centro->id }}" @selected($sangue->centro_id == $centro->id)>
                            {{ $centro->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    @foreach(['quarentena','disponivel','reservada','emitida','transfundida','expirada','descarte'] as $status)
                        <option value="{{ $status }}" @selected($sangue->status == $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Data de Coleta</label>
                <input type="date" name="data_coleta" value="{{ $sangue->data_coleta }}" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Data de Validade</label>
                <input type="date" name="data_validade" value="{{ $sangue->data_validade }}" class="form-control">
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('sangues.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection
