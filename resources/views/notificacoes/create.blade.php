@extends('layouts.layouts')

@section('content')
<div class="container">
    <h2>➕ Nova Notificação</h2>

    <form action="{{ route('notificacoes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}">
        </div>

        <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea name="mensagem" class="form-control" rows="4">{{ old('mensagem') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="canal" class="form-label">Canal</label>
            <select name="canal" class="form-select">
                <option value="email">Email</option>
                <option value="sms">SMS</option>
                <option value="app">App</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="centro_id" class="form-label">Centro</label>
            <select name="centro_id" class="form-select">
                @foreach($centros as $centro)
                    <option value="{{ $centro->id }}">{{ $centro->nome_centro }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('notificacoes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
