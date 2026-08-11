<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Doador</label>
        <select name="doador_id" class="form-select" required>
            <option value="">Selecione...</option>
            @foreach($doadores as $doador)
                <option value="{{ $doador->id }}" {{ old('doador_id', $triagem->doador_id ?? '') == $doador->id ? 'selected' : '' }}>
                    {{ $doador->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Agendamento</label>
        <select name="agendamento_id" class="form-select" required>
            <option value="">Selecione...</option>
            @foreach($agendamentos as $agendamento)
                <option value="{{ $agendamento->id }}" {{ old('agendamento_id', $triagem->agendamento_id ?? '') == $agendamento->id ? 'selected' : '' }}>
                    #{{ $agendamento->id }} - {{ $agendamento->user->name ?? '—' }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- <div class="col-md-6">
        <label class="form-label">Médico Responsável</label>
        <select name="medico_id" class="form-select" required>
            <option value="">Selecione...</option>
            @foreach($medicos as $medico)
                <option value="{{ $medico->id }}" {{ old('medico_id', $triagem->medico_id ?? '') == $medico->id ? 'selected' : '' }}>
                    {{ $medico->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Centro</label>
        <select name="centro_id" class="form-select" required>
            @foreach($centros as $centro)
                <option value="{{ $centro->id }}" {{ old('centro_id', $triagem->centro_id ?? '') == $centro->id ? 'selected' : '' }}>
                    {{ $centro->nome_centro }}
                </option>
            @endforeach
        </select>
    </div>--}}

    <div class="col-md-4">
        <label class="form-label">Pressão Arterial</label>
        <input type="text" name="pressao_arterial" value="{{ old('pressao_arterial', $triagem->pressao_arterial ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Temperatura (°C)</label>
        <input type="text" name="temperatura" value="{{ old('temperatura', $triagem->temperatura ?? '') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Frequência Cardíaca</label>
        <input type="text" name="frequencia_cardiaca" value="{{ old('frequencia_cardiaca', $triagem->frequencia_cardiaca ?? '') }}" class="form-control">
    </div>

    <div class="col-md-3">
        <label class="form-label">Peso (kg)</label>
        <input type="text" name="peso" value="{{ old('peso', $triagem->peso ?? '') }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Altura (cm)</label>
        <input type="text" name="altura" value="{{ old('altura', $triagem->altura ?? '') }}" class="form-control">
    </div>

    <div class="col-md-3">
        <label class="form-label">Apto?</label>
        <select name="apto" class="form-select">
            <option value="0" {{ old('apto', $triagem->apto ?? 0) == 0 ? 'selected' : '' }}>Não</option>
            <option value="1" {{ old('apto', $triagem->apto ?? 0) == 1 ? 'selected' : '' }}>Sim</option>
        </select>
    </div>

    <div class="col-md-12">
        <label class="form-label">Observações</label>
        <textarea name="observacoes" class="form-control" rows="2">{{ old('observacoes', $triagem->observacoes ?? '') }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label text-danger">Motivo de Inaptidão (caso inapto)</label>
        <textarea name="motivo_inapto" class="form-control" rows="2">{{ old('motivo_inapto', $triagem->motivo_inapto ?? '') }}</textarea>
    </div>
</div>
