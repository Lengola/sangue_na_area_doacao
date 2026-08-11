@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h3>✏️ Editar Campanha</h3>
    <form action="{{ route('campanhas.update', $campanha) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $campanha->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao', $campanha->descricao) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="local" class="form-label">Local</label>
            <input type="text" name="local" id="local" class="form-control" value="{{ old('local', $campanha->local) }}">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="data_inicio" class="form-label">Data de Início</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ old('data_inicio', $campanha->data_inicio) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="data_fim" class="form-label">Data de Fim</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{ old('data_fim', $campanha->data_fim) }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="centro_id" class="form-label">Centro de Saúde</label>
            <select name="centro_id" id="centro_id" class="form-select" required>
                @foreach($centros as $centro)
                    <option value="{{ $centro->id }}" {{ old('centro_id', $campanha->centro_id) == $centro->id ? 'selected' : '' }}>
                        {{ $centro->nome_centro }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Atualizar</button>
        <a href="{{ route('campanhas.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
