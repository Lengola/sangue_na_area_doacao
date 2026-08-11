@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🩸 Lista de Doações</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('doacoes.create') }}" class="btn btn-primary">
            ➕ Nova Doação
        </a>
    </div>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Volume (ml)</th>
                <th>Médico</th>
                <th>Centro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($doacoes as $doacao)
                <tr>
                    <td>{{ $doacao->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($doacao->data_doacao)->format('d/m/Y') }}</td>
                    <td>{{ $doacao->tipo_doacao }}</td>
                    <td>
                        <span class="badge bg-{{ $doacao->status === 'Concluída' ? 'success' : ($doacao->status === 'Pendente' ? 'warning' : 'danger') }}">
                            {{ $doacao->status }}
                        </span>
                    </td>
                    <td>{{ $doacao->volume_ml ?? '—' }}</td>
                    <td>{{ $doacao->medico->user->name ?? '—' }}</td>
                    <td>{{ $doacao->centro->nome ?? '—' }}</td>
                    <td>
                        <a href="{{ route('doacoes.show', $doacao->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                        <a href="{{ route('doacoes.edit', $doacao->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <form action="{{ route('doacoes.destroy', $doacao->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Tem certeza que deseja excluir esta doação?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑 Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Nenhuma doação registrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
