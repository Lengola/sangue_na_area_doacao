@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>👁 Detalhes da Doação #{{ $doacao->id }}</h2>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($doacao->data_doacao)->format('d/m/Y') }}</p>
            <p><strong>Tipo:</strong> {{ $doacao->tipo_doacao }}</p>
            <p><strong>Status:</strong> {{ $doacao->status }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($doacao->estado) }}</p>
            <p><strong>Volume:</strong> {{ $doacao->volume_ml ?? '—' }} ml</p>
            <p><strong>Observação:</strong> {{ $doacao->observacao ?? 'Nenhuma' }}</p>
            <p><strong>Médico:</strong> {{ $doacao->medico->user->name ?? '—' }}</p>
            <p><strong>Centro:</strong> {{ $doacao->centro->nome ?? '—' }}</p>
        </div>
    </div>

    <div class="mt-3 text-end">
        <a href="{{ route('doacoes.index') }}" class="btn btn-secondary">⬅ Voltar</a>
        <a href="{{ route('doacoes.edit', $doacao->id) }}" class="btn btn-warning">✏️ Editar</a>
    </div>
</div>
@endsection
