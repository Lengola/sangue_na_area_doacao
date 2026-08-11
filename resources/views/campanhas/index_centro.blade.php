@extends('layouts.layouts')

@section('content')

<div class="container mt-4">

    <div class="text-center mb-5">

        <h1 class="fw-bold text-danger">
            🩸 Campanhas de Doação
        </h1>

        <p class="text-muted">
            Encontre campanhas ativas e contribua para salvar vidas.
        </p>

    </div>

    @if($campanhas->count())

    <div class="row">

        @foreach($campanhas as $campanha)

        <div class="col-md-6 col-lg-4 mb-4">

            <div class="card border-0 shadow-sm h-100 rounded-4">

                <div class="card-body">

                    <span class="badge bg-success mb-3">
                        Ativa
                    </span>

                    <h5 class="fw-bold">
                        {{ $campanha->titulo }}
                    </h5>

                    <p class="text-muted">
                        {{ Str::limit($campanha->descricao, 100) }}
                    </p>

                    <hr>

                    <p class="mb-2">
                        🏥 <strong>Centro:</strong><br>
                        {{ $campanha->centro->nome_centro }}
                    </p>

                    <p class="mb-2">
                        📍 {{ $campanha->local }}
                    </p>

                    <p class="mb-2">
                        📅
                        {{ \Carbon\Carbon::parse($campanha->data_inicio)->format('d/m/Y') }}
                        -
                        {{ \Carbon\Carbon::parse($campanha->data_fim)->format('d/m/Y') }}
                    </p>

                </div>

                <div class="card-footer bg-white border-0">

                    <a href="{{ route('campanhas.show_centro',$campanha) }}"
                       class="btn btn-danger w-100 rounded-pill">

                        Ver Detalhes

                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <div class="mt-4">
        {{ $campanhas->links() }}
    </div>

    @else

    <div class="alert alert-info text-center shadow-sm">

        <h5>
            Nenhuma campanha disponível no momento.
        </h5>

    </div>

    @endif

</div>

@endsection