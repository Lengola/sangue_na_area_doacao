@extends('layouts.layouts')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Médico</h1>
    <form action="{{ route('medicos.update', $medico->id) }}" method="POST" class="user">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="text" name="name" class="form-control" value="{{ $medico->user->name }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="email" name="email" class="form-control" value="{{ $medico->user->email }}" required>
            </div>
        </div>

        <div class="mb-3">
            <input type="text" name="numero_ordem" class="form-control" value="{{ $medico->numero_ordem }}" required>
        </div>

        <div class="mb-3">
            <input type="text" name="especialidade" class="form-control" value="{{ $medico->especialidade }}" required>
        </div>

        <div class="mb-3">
            <input type="text" name="telefone" class="form-control" value="{{ $medico->telefone }}">
        </div>

        <div class="mb-3">
            <input type="text" name="bi" class="form-control" value="{{ $medico->bi }}">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
    </form>
</div>
@endsection
