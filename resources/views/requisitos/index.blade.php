@extends('layouts.layouts') {{-- se já tiver um layout base --}}

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-danger">
            <i class="fas fa-heartbeat"></i> Requisitos para Doação de Sangue
        </h1>
        <p class="text-muted">Antes de doar, verifique se você atende aos requisitos básicos.</p>
    </div>

    <div class="row g-4">
        <!-- Idade -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-birthday-cake fa-3x text-primary mb-3"></i>
                    <h5 class="card-title fw-bold">Idade</h5>
                    <p class="card-text">Entre <strong>16 e 69 anos</strong> (menores de 18 anos precisam de autorização dos pais).</p>
                </div>
            </div>
        </div>

        <!-- Peso -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-weight fa-3x text-success mb-3"></i>
                    <h5 class="card-title fw-bold">Peso</h5>
                    <p class="card-text">O doador deve pesar pelo menos <strong>50 kg</strong>.</p>
                </div>
            </div>
        </div>

        <!-- Saúde -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-stethoscope fa-3x text-danger mb-3"></i>
                    <h5 class="card-title fw-bold">Saúde</h5>
                    <p class="card-text">Estar em boas condições de saúde no dia da doação.</p>
                </div>
            </div>
        </div>

        <!-- Intervalo -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                    <h5 class="card-title fw-bold">Intervalo</h5>
                    <p class="card-text">Homens: <strong>60 dias</strong> | Mulheres: <strong>90 dias</strong> entre doações.</p>
                </div>
            </div>
        </div>

        <!-- Alimentação -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-utensils fa-3x text-info mb-3"></i>
                    <h5 class="card-title fw-bold">Alimentação</h5>
                    <p class="card-text">Estar bem alimentado. Evitar alimentos gordurosos 3 horas antes da doação.</p>
                </div>
            </div>
        </div>

        <!-- Descanso -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-bed fa-3x text-secondary mb-3"></i>
                    <h5 class="card-title fw-bold">Descanso</h5>
                    <p class="card-text">Ter dormido pelo menos <strong>6 horas</strong> na noite anterior.</p>
                </div>
            </div>
        </div>
    </div>

   
</div>
@endsection
