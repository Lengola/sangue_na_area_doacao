<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NovaMensagem;

class TesteController extends Controller
{
    public function enviar()
    {
        $user = User::first();

        $user->notify(new NovaMensagem());

        return "Notificação enviada!";
    }
}