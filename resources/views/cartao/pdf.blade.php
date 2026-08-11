<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans;
        }

        .cartao {
            border: 2px solid #c0392b;
            border-radius: 10px;
            padding: 20px;
        }

        .header {
            background: #c0392b;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .tipo {
            font-size: 35px;
            font-weight: bold;
        }

        .linha {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="cartao">

    <div class="header">
        <h2>Cartão de Doador</h2>

        <div class="tipo">
            {{ $doador->tipo_sanguineo }}
        </div>
    </div>

    <div class="linha">
        <strong>Nome:</strong>
        {{ $doador->user->name }}
    </div>

    <div class="linha">
        <strong>Email:</strong>
        {{ $doador->user->email }}
    </div>

    <div class="linha">
        <strong>BI:</strong>
        {{ $doador->numero_identificacao }}
    </div>

    <div class="linha">
        <strong>Telefone:</strong>
        {{ $doador->telefone }}
    </div>

    <div class="linha">
        <strong>Sexo:</strong>
        {{ $doador->sexo }}
    </div>

</div>

</body>
</html>