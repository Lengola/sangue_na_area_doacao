@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>👁️ Detalhes da Bolsa #{{ $sangue->codigo_bolsa }}</h2>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $sangue->id }}</td></tr>
        <tr><th>Código da Bolsa</th><td>{{ $sangue->codigo_bolsa }}</td></tr>
        <tr><th>Tipo Sanguíneo</th><td>{{ $sangue->tipo_sanguineo }}</td></tr>
        <tr><th>Volume</th><td>{{ $sangue->volume_ml }} ml</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($sangue->status) }}</td></tr>
        <tr><th>Centro</th><td>{{ $sangue->centro->nome_centro ?? '—' }}</td></tr>
        <tr><th>Data de Coleta</th><td>{{ $sangue->data_coleta ?? '—' }}</td></tr>
        <tr><th>Data de Validade</th><td>{{ $sangue->data_validade ?? '—' }}</td></tr>
        <tr><th>Testes</th>
            <td>
                HIV: {{ $sangue->hiv ? 'Positivo' : 'Negativo' }} |
                Hepatite B: {{ $sangue->hepatite_b ? 'Positivo' : 'Negativo' }} |
                Hepatite C: {{ $sangue->hepatite_c ? 'Positivo' : 'Negativo' }} |
                Sífilis: {{ $sangue->sifilis ? 'Positivo' : 'Negativo' }} |
                Malária: {{ $sangue->malaria ? 'Positivo' : 'Negativo' }}
            </td>
        </tr>
    </table>

    <a href="{{ route('sangues.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
