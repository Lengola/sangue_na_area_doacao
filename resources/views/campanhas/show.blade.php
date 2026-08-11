@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h3>📄 Detalhes da Campanha</h3>

    <div class="card p-3 mt-3">
        <h4>{{ $campanha->titulo }}</h4>
        <p><strong>Descrição:</strong> {{ $campanha->descricao ?? 'Sem descrição' }}</p>
        <p><strong>Local:</strong> {{ $campanha->local ?? 'Não informado' }}</p>
        <p><strong>Data de Início:</strong> {{ $campanha->data_inicio }}</p>
        <p><strong>Data de Fim:</strong> {{ $campanha->data_fim }}</p>
        <p><strong>Centro:</strong> {{ $campanha->centro->nome_centro ?? 'N/A' }}</p>

        <a href="{{ route('campanhas.edit', $campanha) }}" class="btn btn-warning mt-3">Editar</a>
        <a href="{{ route('campanhas.index') }}" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</div>
@endsection
