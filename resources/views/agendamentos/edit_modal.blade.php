<div class="modal fade" id="editAgendamentoModal{{ $agendamento->id }}" tabindex="-1" aria-labelledby="editAgendamentoLabel{{ $agendamento->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title fw-bold">
            ✏️ Editar Agendamento #{{ $agendamento->id }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div> Flm da campanha {{ $agendamento->campanha->data_fim }}

        <div class="modal-body">
          <div class="mb-3">
            <label for="data_agendamento{{ $agendamento->id }}" class="form-label">Data do Agendamento</label>
            <input type="date" name="data_agendamento" id="data_agendamento{{ $agendamento->id }}" class="form-control"
                   value="{{ $agendamento->data_agendamento }}"  min="{{ max(date('Y-m-d'), $agendamento->campanha->data_inicio) }}"
            max="{{  $agendamento->campanha->data_fim }}">
          </div>

          <div class="mb-3">
            <label for="hora_agendada{{ $agendamento->id }}" class="form-label">Hora Agendada</label>
            <input type="time" name="hora_agendada" id="hora_agendada{{ $agendamento->id }}" class="form-control"
                   value="{{ $agendamento->hora_agendada }}">
          </div>

          @if(auth()->user()->role === 'medico')
<div class="mb-3"> 
    <label for="status{{ $agendamento->id }}" class="form-label">Status</label>
    <select name="status" id="status{{ $agendamento->id }}" class="form-select">
        <option value="pendente" {{ $agendamento->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
        <option value="confirmado" {{ $agendamento->status == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
        <option value="concluido" {{ $agendamento->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
        <option value="cancelado" {{ $agendamento->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>
</div>
@endif

          <div class="mb-3">
            <label for="motivo_cancelamento{{ $agendamento->id }}" class="form-label">Motivo do Cancelamento</label>
            <textarea name="motivo_cancelamento" id="motivo_cancelamento{{ $agendamento->id }}" class="form-control"
                      rows="3">{{ $agendamento->motivo_cancelamento }}</textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-warning text-white fw-bold">
            <i class="bi bi-save"></i> Atualizar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
