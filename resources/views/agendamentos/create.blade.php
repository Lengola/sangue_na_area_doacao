@extends('layouts.layouts')

@section('content')

<div class="container mt-4">

  <div class="card shadow-lg p-4">

    <h4 class="mb-3">📅 Novo Agendamento</h4>

    <form method="POST" action="{{ route('agendamentos.store') }}">
      @csrf

      <!-- 👤 DADOS DO USUÁRIO -->
      <div class="mb-3">
        <label><strong>Doador</strong></label>
        <input type="text" class="form-control"
               value="{{ auth()->user()->name }}" readonly>
      </div>

      <!-- 🏥 CENTRO -->
      <div class="mb-3">
        <label><strong>Centro</strong></label>
        <input type="text" class="form-control"
               value="{{ $centro->nome_centro }}" readonly>
      </div>

      <!-- 📢 CAMPANHA -->
      <div class="mb-3">
        <label><strong>Campanha</strong></label>
        <input type="text" class="form-control"
               value="{{ $campanha->titulo }}" readonly>
      </div>

      <!-- 📅 DATA -->
      <div class="mb-3">
        <label>Data do Agendamento</label>
        <input type="date" name="data_agendamento"
            class="form-control"
            min="{{ max(date('Y-m-d'), $campanha->data_inicio) }}"
            max="{{ $campanha->data_fim }}"
            required>
                        
      </div>

      <!-- ⏰ HORA -->
      <div class="mb-3">
        <label>Hora</label>
        <select name="hora_agendada" class="form-control">
            
          <option value="">Selecionar hora</option>

          @for ($h = 8; $h <= 17; $h++)
            <option value="{{ $h }}:00">{{ $h }}:00</option>
          @endfor

        </select>
      </div>

      <!-- hidden -->
      <input type="hidden" name="centro_id" value="{{ $centro->id }}">
      <input type="hidden" name="campanha_id" value="{{ $campanha->id }}">

      <!-- BOTÃO -->
      <button class="btn btn-primary w-100">
        ✅ Confirmar Agendamento
      </button>

    </form>

  </div>

</div>

@endsection