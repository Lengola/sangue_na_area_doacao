@extends('layouts.layouts')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">
            <i class="bi bi-calendar-check"></i>
            Gestão de Agendamentos
        </h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Usuário</th>
                            <th>Centro</th>
                            <th>Campanha</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Status</th>
                            <th width="220">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($agendamentos as $agendamento)

                        <tr class="text-center">

                            <td>{{ $agendamento->id }}</td>

                            <td>
                                {{ $agendamento->user->name ?? '—' }}
                            </td>

                            <td>
                                {{ $agendamento->centro->nome_centro ?? '—' }}
                            </td>

                            <td>
                                {{ $agendamento->campanha->titulo ?? '—' }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($agendamento->data_agendamento)->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $agendamento->hora_agendada }}
                            </td>

                            <td>
                                <span class="badge
                                @if($agendamento->status == 'confirmado')
                                    bg-success
                                @elseif($agendamento->status == 'pendente')
                                    bg-warning text-dark
                                @elseif($agendamento->status == 'cancelado')
                                    bg-danger
                                @else
                                    bg-secondary
                                @endif">
                                    {{ ucfirst($agendamento->status) }}
                                </span>
                            </td>

                            <td>

                                @if($agendamento->status == 'confirmado')

                                    <a href="{{ route('doacoes.create', ['agendamento_id' => $agendamento->id]) }}"
                                       class="btn btn-sm btn-success">
                                        <i class="bi bi-droplet-fill"></i>
                                        Doação
                                    </a>

                                @endif

                                <button class="btn btn-sm btn-outline-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editAgendamentoModal{{ $agendamento->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('agendamentos.destroy', $agendamento) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Deseja eliminar este agendamento?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @include('agendamentos.edit_modal',[
                            'agendamento' => $agendamento
                        ])

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-4">
                                Nenhum agendamento encontrado.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>
@endsection