@extends('layouts.layouts')

@section('content')
<div class="container">
    <h2>📄 Detalhes da Notificação</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $notificaco->titulo }}</h4>
            <p><strong>Canal:</strong> {{ strtoupper($notificaco->canal) }}</p>
            <p><strong>Centro:</strong> {{ $notificaco->centro->nome_centro ?? 'N/A' }}</p>
            <p><strong>Mensagem:</strong></p>
            <p>{{ $notificaco->mensagem }}</p>
            <p><strong>Status:</strong> {{ $notificaco->lida ? 'Lida ✅' : 'Não lida ❌' }}</p>
            <p><strong>Enviada em:</strong> {{ $notificaco->enviada_em ? $notificaco->enviada_em->format('d/m/Y H:i') : 'Não enviada' }}</p>
        </div>
    </div>

    <a href="{{ route('notificacoes.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
