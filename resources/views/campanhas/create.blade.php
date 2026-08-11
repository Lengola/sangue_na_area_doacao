@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h3>➕ Nova Campanha</h3>
    <form action="{{ route('campanhas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo') }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="local" class="form-label">Local</label>
            <input type="text" name="local" id="local" class="form-control" value="{{ old('local') }}">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="data_inicio" class="form-label">Data de Início</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ old('data_inicio') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="data_fim" class="form-label">Data de Fim</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{ old('data_fim') }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="centro_id" class="form-label">Centro de Saúde</label>
            <select name="centro_id" id="centro_id" class="form-select" required>
                <option value="">-- Selecione o centro --</option>
                @foreach($centros as $centro)
                    <option value="{{ $centro->id }}" {{ old('centro_id') == $centro->id ? 'selected' : '' }}>
                        {{ $centro->nome_centro }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('campanhas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
