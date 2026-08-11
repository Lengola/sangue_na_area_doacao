<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\LembreteDoacaoMail;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable; // 👈 ESSENCIAL
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class EnviarLembreteDoacaoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $agendamentos;

    public function __construct($agendamentos)
    {
        $this->agendamentos = $agendamentos;
    }

    public function handle()
    {
        foreach ($this->agendamentos as $agendamento) {

            if (!$agendamento->user || !$agendamento->user->email) {
                continue;
            }

            Mail::to($agendamento->user->email)
                ->send(new LembreteDoacaoMail($agendamento));
        }
    }
}