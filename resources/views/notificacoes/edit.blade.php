@extends('layouts.layouts')

@section('content')
<div class="container">
    <h2>✏️ Editar Notificação</h2>

    <form action="{{ route('notificacoes.update', $notificaco->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $notificaco->titulo) }}">
        </div>

        <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea name="mensagem" class="form-control" rows="4">{{ old('mensagem', $notificaco->mensagem) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="canal" class="form-label">Canal</label>
            <select name="canal" class="form-select">
                @foreach(['email','sms','app'] as $canal)
                    <option value="{{ $canal }}" @selected($notificaco->canal == $canal)>{{ strtoupper($canal) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="centro_id" class="form-label">Centro</label>
            <select name="centro_id" class="form-select">
                @foreach($centros as $centro)
                    <option value="{{ $centro->id }}" @selected($notificaco->centro_id == $centro->id)>{{ $centro->nome_centro }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-check-label">
                <input type="checkbox" name="lida" value="1" @checked($notificaco->lida)> Marcar como lida
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('notificacoes.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
