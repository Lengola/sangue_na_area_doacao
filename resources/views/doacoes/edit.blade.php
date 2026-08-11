@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>✏️ Editar Doação #{{ $doacao->id }}</h2>

    <form action="{{ route('doacoes.update', $doacao->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="Pendente" {{ $doacao->status === 'Pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="Concluída" {{ $doacao->status === 'Concluída' ? 'selected' : '' }}>Concluída</option>
                <option value="Cancelada" {{ $doacao->status === 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
                <option value="coletada" {{ $doacao->estado === 'coletada' ? 'selected' : '' }}>Coletada</option>
                <option value="em_teste" {{ $doacao->estado === 'em_teste' ? 'selected' : '' }}>Em Teste</option>
                <option value="aprovada" {{ $doacao->estado === 'aprovada' ? 'selected' : '' }}>Aprovada</option>
                <option value="rejeitada" {{ $doacao->estado === 'rejeitada' ? 'selected' : '' }}>Rejeitada</option>
                <option value="processada" {{ $doacao->estado === 'processada' ? 'selected' : '' }}>Processada</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Observações</label>
            <textarea name="observacao" class="form-control" rows="3">{{ $doacao->observacao }}</textarea>
        </div>

        <div class="text-end">
            <a href="{{ route('doacoes.index') }}" class="btn btn-secondary">⬅ Voltar</a>
            <button type="submit" class="btn btn-success">💾 Atualizar</button>
        </div>
    </form>
</div>
@endsection
