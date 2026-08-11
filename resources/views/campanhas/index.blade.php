@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📢 Campanhas</h3>
        <a href="{{ route('campanhas.create') }}" class="btn btn-primary">+ Nova Campanha</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Local</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Centro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($campanhas as $campanha)
                <tr>
                    <td>{{ $campanha->id }}</td>
                    <td>{{ $campanha->titulo }}</td>
                    <td>{{ $campanha->local ?? '-' }}</td>
                    <td>{{ $campanha->data_inicio }}</td>
                    <td>{{ $campanha->data_fim }}</td>
                    <td>{{ $campanha->centro->nome_centro ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('campanhas.show', $campanha) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('campanhas.edit', $campanha) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('campanhas.destroy', $campanha) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Deseja excluir esta campanha?')" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Nenhuma campanha cadastrada.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
