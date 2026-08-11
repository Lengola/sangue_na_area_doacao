@extends('layouts.layouts')

@section('content')
<div class="container">

    <style>
        .cartao {
            width: 500px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,.2);
        }

        .cartao-header {
            background: #c0392b;
            color: white;
            padding: 20px;
        }

        .tipo {
            font-size: 40px;
            font-weight: bold;
        }

        .cartao-body {
            background: white;
            padding: 20px;
        }

        .linha {
            margin-bottom: 10px;
        }

        .icone {
            color: #c0392b;
            width: 25px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="cartao mx-auto">

        <div class="cartao-header text-center">
            <h3>
                <i class="fas fa-heartbeat"></i>
                Cartão de Doador
            </h3>

            <div class="tipo">
                {{ $doador->tipo_sanguineo }}
            </div>
        </div>

        <div class="cartao-body">

            <div class="linha">
                <i class="fas fa-user icone"></i>
                <strong>Nome:</strong>
                {{ $doador->user->name }}
            </div>

            <div class="linha">
                <i class="fas fa-id-card icone"></i>
                <strong>BI:</strong>
                {{ $doador->numero_identificacao }}
            </div>

            <div class="linha">
                <i class="fas fa-phone icone"></i>
                <strong>Telefone:</strong>
                {{ $doador->telefone }}
            </div>

            <div class="linha">
                <i class="fas fa-venus-mars icone"></i>
                <strong>Sexo:</strong>
                {{ $doador->sexo }}
            </div>

            <div class="linha">
                <i class="fas fa-weight icone"></i>
                <strong>Peso:</strong>
                {{ $doador->peso }} KG
            </div>

            <div class="linha">
                <i class="fas fa-calendar icone"></i>
                <strong>Última Doação:</strong>
                {{ optional($doador->ultimo_agendamento)->format('d/m/Y') }}
            </div>

            <hr>

            <a href="{{ route('cartao.pdf', $doador->id) }}"
               class="btn btn-danger btn-block">
                <i class="fas fa-file-pdf"></i>
                Baixar PDF
            </a>

        </div>
    </div>

</div>

</div>
@endsection