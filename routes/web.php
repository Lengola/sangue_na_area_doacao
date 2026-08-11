<?php

use App\Http\Controllers\NotificacaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\SangueController;
use App\Http\Controllers\RequisitosController;
use App\Http\Controllers\TriagemController;
use App\Http\Controllers\UserController;
use App\Models\Centro;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\CartaoDoacaoController;

use Carbon\Carbon;

Route::put('/triagens/{triagem}', [TriagemController::class, 'update'])->name('triagens.update1');

Route::get('/', function () {
    return view('welcome');
});

//user

        Route::resource('users', UserController::class);
    
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
//------------------------------------------------------------------
Route::get('/1', function () {
        return view('dashboard');
    })->name('dashboard1');
//------------------------------------------------------------------


Route::get('/cadastro', [CadastroController::class, 'showForm'])->name('cadastro.form');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');
//------------------------------------------------------------------



Route::resource('medicos', MedicoController::class);
//------------------------------------------------------------------
Route::resource('agendamentos',AgendamentoController::class);
//------------------------------------------------------------------
Route::resource('doacoes', DoacaoController::class)->parameters([
    'doacoes' => 'doacao'
]);
//------------------------------------------------------------------
Route::resource('sangues', SangueController::class);
//------------------------------------------------------------------


Route::get('/requisitos', [RequisitosController::class, 'index'])->name('requisitos.index');
//------------------------------------------------------------------
use App\Http\Controllers\CampanhaController;
use App\Http\Controllers\TesteController;

Route::middleware(['auth'])->group(function () {
    Route::resource('campanhas', CampanhaController::class);

     Route::get('/campanhas_centro', [CampanhaController::class, 'index_centro'])
        ->name('campanhas.index_centro');

    Route::get('/campanhas_centro/{campanha}', [CampanhaController::class, 'show_centro'])
        ->name('campanhas.show_centro');


});







Route::resource('triagens', TriagemController::class);//triagem


Route::resource('notificacoes', NotificacaoController::class);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/dashboard',[CadastroController::class, 'index'])->name('dashboard');

   

/*Route::get('/mapa', function () {

    $centros = Centro::with('campanhas')->get();
    //var centros = @json($centros ?? []);
    return view('mapa', compact('centros'));
})->name('mapa');
*/
});



Route::get('/mapa', function () {

    $centros = Centro::with(['campanhas' => function ($q) {
        $q->where(function ($query) {
            $query->whereNull('data_fim')
                  ->orWhere('data_fim', '>=', Carbon::today());
        });
    }])->get();

    return view('mapa', compact('centros'));
})->name('mapa');
//------------------------------------------------------------------



//Rota se email
// Rotas de verificação de email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard'); // para onde vai depois de verificar
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link de verificação enviado!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//test email
use Illuminate\Support\Facades\Mail;
use App\Mail\LembreteDoacaoMail; 
use App\Models\Agendamento;

Route::get('/teste-email', function () {

    $agendamento = Agendamento::with('user', 'centro')->first();

    Mail::to('teu_email@gmail.com')
        ->send(new LembreteDoacaoMail($agendamento));

    return "Email enviado!";
});
//-----------------------------------------------------





Route::get('/horarios-disponiveis', [AgendamentoController::class, 'horarios']);

//notificacao

Route::get('/enviar', [TesteController::class, 'enviar']);



Route::post('/notificacao/{id}/ler', function ($id) {
    $notificacao = auth()->user()->notifications()->findOrFail($id);
    $notificacao->markAsRead();

    return back();
});


//cartao

Route::get('/cartao/{id}', [CartaoDoacaoController::class, 'show'])
    ->name('cartao.show');

Route::get('/cartao/{id}/pdf', [CartaoDoacaoController::class, 'downloadPdf'])
    ->name('cartao.pdf');