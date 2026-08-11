<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agendamento;
use App\Jobs\EnviarLembreteDoacaoJob;
use Carbon\Carbon;

class EnviarLembretesDoacao extends Command
{
    protected $signature = 'lembretes:doacao';
    protected $description = 'Enviar emails de lembrete de doação';

    public function handle()
{
    \Log::info('COMMAND INICIADO');

    $amanha = Carbon::tomorrow()->toDateString();

    Agendamento::with(['user', 'doador', 'centro'])
        ->whereDate('data_agendamento', $amanha)
        ->whereIn('status', ['pendente', 'confirmado'])
        ->chunkById(200, function ($agendamentos) {

            \Log::info('TOTAL ENCONTRADO: ' . count($agendamentos));

            $grupos = $agendamentos->groupBy(function ($item) {
                return optional($item->doador)->tipo_sanguineo ?? 'outros';
            });

            foreach ($grupos as $tipo => $grupo) {

                \Log::info('DISPARANDO JOB PARA TIPO: ' . $tipo);

                EnviarLembreteDoacaoJob::dispatch($grupo)
                    ->delay(now()->addSeconds(rand(5, 60)));
            }

        });

    return 0;
}
}