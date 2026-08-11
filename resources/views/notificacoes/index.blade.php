@extends('layouts.layouts')

@section('content')
<div class="container">
    <h2 class="mb-4">📢 Lista de Notificações</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('notificacoes.create') }}" class="btn btn-primary mb-3">➕ Nova Notificação</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Canal</th>
                <th>Centro</th>
                <th>Enviada em</th>
                <th>Lida?</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notificacoes as $notificacao)
                <tr>
                    <td>{{ $notificacao->titulo }}</td>
                    <td>{{ ucfirst($notificacao->canal) }}</td>
                    <td>{{ $notificacao->centro->nome_centro ?? 'N/A' }}</td>
                    <td>{{ $notificacao->enviada_em ? $notificacao->enviada_em->format('d/m/Y H:i') : '-' }}</td>
                    <td>
                        @if($notificacao->lida)
                            ✅ Lida
                        @else
                            ❌ Não lida
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('notificacoes.show', $notificacao->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('notificacoes.edit', $notificacao->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('notificacoes.destroy', $notificacao->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza?')" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
