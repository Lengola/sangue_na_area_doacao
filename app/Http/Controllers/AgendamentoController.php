<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\User;
use App\Models\Centro;
use App\Models\Campanha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
   /* public function index()
    {
        $agendamentos = Agendamento::with(['user', 'centro', 'campanha'])
            ->orderBy('data_agendamento', 'desc')
            ->get();

        $usuarios = User::all();
        $centros = Centro::all();
        $campanhas = Campanha::all();

        return view('agendamentos.index', compact('agendamentos', 'usuarios', 'centros', 'campanhas'));
    }*/

    public function index()
{
    $user = Auth::user();

    $query = Agendamento::with(['user', 'centro', 'campanha']);

    // 🔹 Se for DOADOR
    if ($user->isDoador()) {

        $query->where('user_id', $user->id);

    }

    // 🔹 Se for CENTRO
    elseif ($user->isCentro()) {

        $centro = $user->centro;

        if ($centro) {
            $query->where('centro_id', $centro->id);
        }

    }

    // 🔹 Se for MÉDICO
    elseif ($user->isMedico()) {

        $medico = $user->medico;

        if ($medico && $medico->centro_id) {
            $query->where('centro_id', $medico->centro_id);
        }

    }

    // 🔹 Admin vê tudo
    elseif ($user->isAdmin()) {
        // sem filtro
    }

    $agendamentos = $query
        ->orderBy('data_agendamento', 'desc')
        ->get();

    $usuarios = User::all();
    $centros = Centro::all();
    $campanhas = Campanha::all();

    return view('agendamentos.index', compact(
        'agendamentos',
        'usuarios',
        'centros',
        'campanhas'
    ));
}

    public function store(Request $request)
{
    $request->validate([
        'centro_id' => 'required|exists:centros,id',
        'campanha_id' => 'nullable|exists:campanhas,id',
        'data_agendamento' => 'required|date|after_or_equal:today',
        'hora_agendada' => 'nullable'
    ]);

    Agendamento::create([
        'user_id' => Auth::id(),
        'centro_id' => $request->centro_id,
        'campanha_id' => $request->campanha_id,
        'data_agendamento' => $request->data_agendamento,
        'hora_agendada' => $request->hora_agendada,
        'status' => 'pendente'
    ]);

    return redirect()->route('mapa')->with('success', 'Agendamento realizado com sucesso!');
}


public function create(Request $request)
{
    $centro = Centro::findOrFail($request->centro);

    $campanha = Campanha::where('id', $request->campanha)
        ->where('centro_id', $centro->id)
        ->where(function ($q) {
            $q->whereNull('data_fim')
              ->orWhere('data_fim', '>=', now());
        })
        ->firstOrFail();

    return view('agendamentos.create', compact('centro', 'campanha'));
}


   public function update(Request $request, $id)
{
    $agendamento = Agendamento::findOrFail($id);

    $request->validate([
        'data_agendamento' => 'required|date',
        'hora_agendada' => 'nullable',
        'status' => 'required|in:pendente,confirmado,concluido,cancelado',
        'motivo_cancelamento' => 'nullable|string|max:255',
    ]);

    $agendamento->update([
        'data_agendamento' => $request->data_agendamento,
        'hora_agendada' => $request->hora_agendada,
        'status' => $request->status,
        'motivo_cancelamento' => $request->motivo_cancelamento,
    ]);

    return redirect()->back()->with('success', '✅ Agendamento atualizado com sucesso!');
}


    public function destroy(Agendamento $agendamento)
    {
        $agendamento->delete();

        return redirect()->route('agendamentos.index')
            ->with('success', '🗑️ Agendamento removido com sucesso!');
    }





    public function horarios(Request $request)
{
    $horariosBase = [];

    // horários do sistema (08h às 17h)
    for ($h = 8; $h <= 17; $h++) {
        $horariosBase[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
    }

    $disponiveis = [];

    foreach ($horariosBase as $hora) {

        $total = \App\Models\Agendamento::where('campanha_id', $request->campanha)
            ->where('data_agendamento', $request->data)
            ->where('hora_agendada', $hora)
            ->whereIn('status', ['pendente', 'confirmado'])
            ->count();

        // 🔥 só entra se tiver menos de 3 pessoas
        if ($total < 3) {
            $disponiveis[] = $hora;
        }
    }

    return response()->json($disponiveis);
}
}


