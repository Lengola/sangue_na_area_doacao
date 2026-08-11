<?php

namespace App\Mail; // Adiciona esta linha!

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LembreteDoacaoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agendamento;

    public function __construct($agendamento)
    {
        $this->agendamento = $agendamento;
    }

    public function build()
    {
        return $this->subject('Lembrete de Doação de Sangue')
                    ->view('emails.lembrete-doacao');
    }
}
