@csrf

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Erros encontrados:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label>Usuário</label>
    <select name="user_id" class="form-select" required>
        <option value="">-- Selecione --</option>
        @foreach($usuarios as $user)
            <option value="{{ $user->id }}"
                {{ (old('user_id', $agendamento->user_id ?? '') == $user->id) ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Centro de Saúde</label>
    <select name="centro_id" class="form-select" required>
        <option value="">-- Selecione --</option>
        @foreach($centros as $centro)
            <option value="{{ $centro->id }}"
                {{ (old('centro_id', $agendamento->centro_id ?? '') == $centro->id) ? 'selected' : '' }}>
                {{ $centro->nome_centro }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Campanha (opcional)</label>
    <select name="campanha_id" class="form-select">
        <option value="">-- Nenhuma --</option>
        @foreach($campanhas as $campanha)
            <option value="{{ $campanha->id }}"
                {{ (old('campanha_id', $agendamento->campanha_id ?? '') == $campanha->id) ? 'selected' : '' }}>
                {{ $campanha->titulo }}
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label>Data do Agendamento</label>
        <input type="date" name="data_agendamento" class="form-control"
            value="{{ old('data_agendamento', $agendamento->data_agendamento ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label>Hora Agendada</label>
        <input type="time" name="hora_agendada" class="form-control"
            value="{{ old('hora_agendada', $agendamento->hora_agendada ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-select">
        @foreach(['pendente', 'confirmado', 'concluido', 'cancelado'] as $status)
            <option value="{{ $status }}"
                {{ (old('status', $agendamento->status ?? 'pendente') == $status) ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Motivo de Cancelamento (opcional)</label>
    <textarea name="motivo_cancelamento" class="form-control" rows="2">{{ old('motivo_cancelamento', $agendamento->motivo_cancelamento ?? '') }}</textarea>
</div>
