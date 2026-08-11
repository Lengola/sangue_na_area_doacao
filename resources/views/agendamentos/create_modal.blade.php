<div class="modal fade" id="createAgendamentoModal" tabindex="-1" aria-labelledby="createAgendamentoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form action="{{ route('agendamentos.store') }}" method="POST">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Novo Agendamento</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          @include('agendamentos._form')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
