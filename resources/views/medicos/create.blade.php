@extends('layouts.layouts')

@section('title','Cadastrar Médico')

@section('content')
<div class="container py-4">
    <h3>Cadastrar Médico</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicos.store') }}" method="POST" enctype="multipart/form-data" class="card p-4">
        @csrf
        <h5>Dados Pessoais</h5>
        <div class="row g-3 mb-3">
            <div class="col-md-6"><label>Nome</label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
            <div class="col-md-6"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>
            <div class="col-md-4"><label>Senha (opcional)</label><input type="password" name="password" class="form-control"></div>
            <div class="col-md-4"><label>Ativo?</label>
                <select name="ativo" class="form-select">
                    <option value="1" selected>Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="col-md-4"><label>Foto de Perfil</label><input type="file" name="profile_photo" class="form-control"></div>
        </div>

        <h5>Dados do Médico</h5>
        <div class="row g-3 mb-3">
            <div class="col-md-6"><label>Especialidade</label><input type="text" name="especialidade" class="form-control" value="{{ old('especialidade') }}" required></div>
            <div class="col-md-6"><label>Nº Ordem</label><input type="text" name="numero_ordem" class="form-control" value="{{ old('numero_ordem') }}" required></div>
            <div class="col-md-6"><label>Telefone</label><input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}"></div>
            <div class="col-md-6"><label>Centro</label>
                <select name="centro_id" class="form-select" required>
                    <option value="">Selecione...</option>
                    @foreach($centros as $c) <option value="{{ $c->id }}">{{ $c->nome_centro }}</option> @endforeach
                </select>
            </div>
        </div>

        <h5>Endereço</h5>
        <div class="row g-3 mb-3">
            <div class="col-md-4"><label>Cidade</label><input type="text" name="cidade" class="form-control" value="{{ old('cidade') }}"></div>
            <div class="col-md-4"><label>Província</label><input type="text" name="provincia" class="form-control" value="{{ old('provincia') }}"></div>
            <div class="col-md-4"><label>País</label><input type="text" name="pais" class="form-control" value="{{ old('pais','Angola') }}"></div>
            <div class="col-md-6"><label>Latitude</label><input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}"></div>
            <div class="col-md-6"><label>Longitude</label><input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}"></div>
        </div>

        <div class="text-end">
            <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button class="btn btn-primary">Salvar médico</button>
        </div>
    </form>
</div>
@endsection
