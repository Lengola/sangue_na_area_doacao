<h2>Olá {{ $agendamento->user->name }}</h2>

<p>Este é um lembrete da sua doação de sangue.</p>

<p><strong>Data:</strong> {{ $agendamento->data_agendamento }}</p>
<p><strong>Centro:</strong> {{ $agendamento->centro->nome }}</p>

<p>Contamos com você ❤️</p>