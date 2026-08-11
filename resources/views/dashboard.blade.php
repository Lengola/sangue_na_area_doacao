@extends('layouts.layouts')
{{-- @section('content')

@can('acessar-Doador')
<h1>Doador</h1>
@endcan
@can('acessar-Medico')
<h1>Medico</h1>
@endcan
@can('acessar-Centro')
<h1>Centro de Saude</h1>
@endcan

doa dor<br>
<a href="{{ route("agendamentos.index") }}">Agendar Doação</a><br>
<a href="">Minhas Doações Ver historicos</a><br>
<a href="">Ver centros de saudes associados</a><br>
<a href=""></a>
<a href=""></a>
<a href=""></a>
<br>
centro de saude<br>
📌 Agendamentos<br>
<a href="">Ver Agendamentos</a><br>
<a href="">Confirmar Agendamento</a><br>
📌 Estoque de Sangue<br>
<a href="">- Consultar Estoque</a><br>
<a href=""> - Atualizar Estoque</a><br>
📌 Doações<br>
<a href="">- Registrar Coleta</a><br>
<a href="">- Histórico de Coletas</a><br>
<br>

Medico <br>
📌Agendamentos
<a href="">Lista de Agendamentos</a><br>
<a href="{{ route("sangues.index") }}">sangue exame</a><br>
<a href="">Confirmar Agendamento</a><br>
📌 Doações <br>
<a href="{{ route("doacoes.index") }}">Registrar Doação</a><br>
<a href="">Histórico de Doações</a><br>
📌Doadores <br>
<a href="">Lista de Doadores</a><br>
<a href="">Detalhes do Doador</a><br>

@endsection
--}}
@can('acessar-Centro')
@section('content')
<div class="container-fluid px-4">
    <!-- Título -->
    <h1 class="mt-4">Painel de Doadores</h1>
    <p class="text-muted">Bem-vindo, {{ Auth::user()->name }} 👋</p>

    <!-- Resumo -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-primary text-white shadow rounded-3">
                <div class="card-body">
                    Total de Doadores
                    <h3>{{ $totalDoadores }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success text-white shadow rounded-3">
                <div class="card-body">
                    Doadores Ativos
                    <h3>{{ $doadoresAtivos }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-warning text-dark shadow rounded-3">
                <div class="card-body">
                    Último Agendamento
                    <h5>{{ $ultimoAgendamento ?? 'Nenhum' }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header">Distribuição por Sexo</div>
                <div class="card-body">
                    <canvas id="chartSexo" class="chart-pie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header">Tipos Sanguíneos</div>
                <div class="card-body">
                    <canvas id="chartSangue" class="chart-bar"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimos doadores -->
    <div class="card shadow mb-4">
        <div class="card-header">Últimos Doadores Cadastrados</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($ultimosDoadores as $doador)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $doador->user->name }} - {{ $doador->tipo_sanguineo }}
                        <span class="badge bg-primary">{{ $doador->sexo }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sexo
    new Chart(document.getElementById('chartSexo'), {
        type: 'pie',
        data: {
            labels: ['Masculino', 'Feminino', 'Outros'],
            datasets: [{
                data: [{{ $sexoM }}, {{ $sexoF }}, {{ $sexoO }}],
                backgroundColor: ['#36A2EB','#FF6384','#FFCE56']
            }]
        }
    });

    // Tipos sanguíneos
    new Chart(document.getElementById('chartSangue'), {
        type: 'bar',
        data: {
            labels: ['A+','A-','B+','B-','AB+','AB-','O+','O-'],
            datasets: [{
                label: 'Doadores',
                data: {!! json_encode($tiposSanguineos) !!},
                backgroundColor: '#4e73df'
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection

@endcan




{{-- Adimin --}}
 @can('acessar-Admin')
@section('content')
<div class="container-fluid">

    <div class="row">

        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    Usuários
                    <h3>{{ $usuarios }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    Centros
                    <h3>{{ $centros }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    Médicos
                    <h3>{{ $medicos }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    Doadores
                    <h3>{{ $doadores }}</h3>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@endcan