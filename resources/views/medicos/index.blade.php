@extends('layouts.layouts')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Médicos</h1>
    <a href="{{ route('medicos.create') }}" class="btn btn-primary mb-3">+ Adicionar Médico</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Especialidade</th>
                <th>Número Ordem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicos as $medico)
            <tr>
                <td>{{ $medico->user->name }}</td>
                <td>{{ $medico->user->email }}</td>
                <td>{{ $medico->especialidade }}</td>
                <td>{{ $medico->numero_ordem }}</td>
                <td>
                    <a href="{{ route('medicos.edit', $medico->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Remover este médico?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $medicos->links() }}
</div>
@endsection
