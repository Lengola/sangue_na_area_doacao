@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">🩺 Triagens Médicas</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTriagemModal">
            <i class="bi bi-plus-circle"></i> Nova Triagem
        </button>
    </div>

    @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if($errors->any())
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>⚠️ Erros de validação:</strong>
      <ul class="mb-0">
          @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif


    <div class="table-responsive shadow rounded">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Doador</th>
                    <th>Médico</th>
                    <th>Centro</th>
                    <th>Pressão</th>
                    <th>Temp.</th>
                    <th>Apto</th>
                    <th>Data</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($triagens as $triagem)
                    <tr>
                        <td>{{ $triagem->id }}</td>
                        <td>{{ $triagem->doador->user->name ?? '—' }}</td>
                        <td>{{ $triagem->medico->user->name ?? '—' }}</td>
                        <td>{{ $triagem->centro->nome_centro ?? '—' }}</td>
                        <td>{{ $triagem->pressao_arterial ?? '—' }}</td>
                        <td>{{ $triagem->temperatura ?? '—' }}</td>
                        <td>
                            @if($triagem->apto)
                                <span class="badge bg-success">Apto</span>
                            @else
                                <span class="badge bg-danger">Inapto</span>
                            @endif
                        </td>
                        <td>{{ $triagem->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editTriagemModal{{ $triagem->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('triagens.destroy', $triagem) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir esta triagem?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal de Edição --}}
                    @include('triagens.edit_modal', ['triagem' => $triagem])
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Nenhuma triagem registrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal de Criação --}}
@include('triagens.create_modal')
@endsection
