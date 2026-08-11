<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {

    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Exemplo: Executar todos os dias às 08:00
//Schedule::command('lembretes:doacao')->dailyAt('23:49');

// Ou, para testar agora (a cada minuto):
Schedule::command('lembretes:doacao')->everyMinute();

/* $schedule->command('lembretes:doacao')
    ->dailyAt('00:37')
    ->timezone('Africa/Luanda');*/