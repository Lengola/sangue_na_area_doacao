@extends('layouts.layouts')

@section('content')

<h2>Notificações</h2>

<ul>
@foreach(auth()->user()->unreadNotifications as $notificacao)
    <li>
        <strong>{{ $notificacao->data['titulo'] }}</strong><br>
        {{ $notificacao->data['mensagem'] }}<br>

        <a href="{{ $notificacao->data['link'] }}">
            Ver
        </a>

        <p>
Notificações não lidas: {{ auth()->user()->unreadNotifications->count() }}
</p>

        <p>
Notificações não lidas: {{ auth()->user()->unreadNotifications->count() }}
</p>

        <form method="POST" action="/notificacao/{{ $notificacao->id }}/ler">
            @csrf
            <button type="submit">Marcar como lida</button>
        </form>
    </li>
@endforeach
</ul>
@endsection



<script>
if (Notification.permission === "granted") {
    new Notification("Nova mensagem!");
} else {
    Notification.requestPermission();
}
</script>