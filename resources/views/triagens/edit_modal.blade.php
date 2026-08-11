<div class="modal fade" id="editTriagemModal{{ $triagem->id }}" tabindex="-1" aria-labelledby="editTriagemLabel{{ $triagem->id }}" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <form action="{{ route('triagens.update', $triagem->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header bg-warning">
          <h5 class="modal-title">✏️ Editar Triagem #{{ $triagem->id }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          @include('triagens._form')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-warning">Atualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
