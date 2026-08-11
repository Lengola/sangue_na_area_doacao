@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">🩸 Bolsas de Sangue</h2>

    <a href="{{ route('sangues.create') }}" class="btn btn-primary mb-3">➕ Nova Bolsa</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Código Bolsa</th>
                <th>Tipo</th>
                <th>Volume (ml)</th>
                <th>Status</th>
                <th>Centro</th>
                <th>Data Coleta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sangues as $sangue)
                <tr>
                    <td>{{ $sangue->id }}</td>
                    <td>{{ $sangue->codigo_bolsa }}</td>
                    <td>{{ $sangue->tipo_sanguineo }}</td>
                    <td>{{ $sangue->volume_ml ?? '—' }}</td>
                    <td>{{ ucfirst($sangue->status) }}</td>
                    <td>{{ $sangue->centro->nome_centro ?? '—' }}</td>
                    <td>{{ $sangue->data_coleta ?? '—' }}</td>
                    <td>
                        <a href="{{ route('sangues.show', $sangue->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('sangues.edit', $sangue->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('sangues.destroy', $sangue->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">Nenhuma bolsa registrada.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
