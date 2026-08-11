@extends('layouts.layouts')

@section('content')

<div class="container mt-5">

    <div class="card shadow border-0">

        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">
                Registrar Doação
            </h4>
        </div>

        <div class="card-body">

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('doacoes.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Agendamento
                    </label>

                    <select name="agendamento_id"
                            class="form-select"
                            required>

                        <option value="">
                            Selecione
                        </option>

                        @foreach($agendamentos as $agendamento)

                            <option
                                value="{{ $agendamento->id }}"
                                {{ old('agendamento_id',$agendamentoSelecionado) == $agendamento->id ? 'selected' : '' }}>

                                #{{ $agendamento->id }}
                                -
                                {{ $agendamento->doador->user->name ?? 'Sem nome' }}
                                -
                                {{ $agendamento->data_agendamento }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Data da Doação
                    </label>

                    <input type="date"
                           name="data_doacao"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Tipo de Doação
                    </label>

                    <select name="tipo_doacao"
                            class="form-select">

                        <option value="Sangue Total">
                            Sangue Total
                        </option>

                        <option value="Plasma">
                            Plasma
                        </option>

                        <option value="Plaquetas">
                            Plaquetas
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Volume (ml)
                    </label>

                    <input type="number"
                           name="volume_ml"
                           class="form-control"
                           value="450"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Estado
                    </label>

                    <select name="estado"
                            class="form-select">

                        <option value="coletada">
                            Coletada
                        </option>

                        <option value="em_teste">
                            Em Teste
                        </option>

                        <option value="aprovada">
                            Aprovada
                        </option>

                        <option value="rejeitada">
                            Rejeitada
                        </option>

                        <option value="processada">
                            Processada
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select">

                        <option value="Concluída">
                            Concluída
                        </option>

                        <option value="Pendente">
                            Pendente
                        </option>

                        <option value="Cancelada">
                            Cancelada
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Observação
                    </label>

                    <textarea
                        name="observacao"
                        class="form-control"
                        rows="4"></textarea>

                </div>

                <button class="btn btn-success">
                    Salvar Doação
                </button>

                <a href="{{ route('doacoes.index') }}"
                   class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</div>

@endsection