@extends('layouts.layouts')

@section('content')

<div class="container mt-4">

    <div class="card border-0 shadow rounded-4">

        <div class="card-body p-5">

            <span class="badge bg-success mb-3">
                Campanha Ativa
            </span>

            <h2 class="fw-bold text-danger">
                {{ $campanha->titulo }}
            </h2>

            <hr>

            <p>
                {{ $campanha->descricao }}
            </p>

            <div class="row mt-4">

                <div class="col-md-6">

                    <div class="card bg-light border-0">

                        <div class="card-body">

                            <h5>🏥 Centro</h5>

                            <p>
                                {{ $campanha->centro->nome_centro }}
                            </p>

                            <p>
                                {{ $campanha->centro->responsavel }}
                            </p>

                            <p>
                                {{ $campanha->centro->telefone }}
                            </p>

                            <p>
                                {{ $campanha->centro->email }}
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="card bg-light border-0">

                        <div class="card-body">

                            <h5>📍 Localização</h5>

                            <p>{{ $campanha->local }}</p>

                            <h5>📅 Período</h5>

                            <p>
                                {{ \Carbon\Carbon::parse($campanha->data_inicio)->format('d/m/Y') }}
                                até
                                {{ \Carbon\Carbon::parse($campanha->data_fim)->format('d/m/Y') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="mt-4">

                <a href="{{ route('campanhas.index_centro') }}"
                   class="btn btn-outline-secondary">

                    ← Voltar

                </a>

            </div>

        </div>

    </div>

</div>

@endsection