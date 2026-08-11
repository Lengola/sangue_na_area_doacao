<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NovaMensagem extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database']; // vamos usar só database
    }

    public function toArray($notifiable)
    {
        return [
            'titulo' => 'Nova mensagem',
            'mensagem' => 'Você recebeu uma nova mensagem!',
            'link' => '/mensagens'
        ];
    }
}