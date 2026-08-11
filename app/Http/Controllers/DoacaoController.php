<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoacaoController extends Controller
{
    /**
     * 🔹 Exibir todas as doações
     */
   public function index()
{
    $user = auth()->user();

    $query = Doacao::with([
        'medico.user',
        'centro',
        'agendamento.doador.user'
    ]);

    /**
     * 🔹 Se for MÉDICO
     * Lista apenas doações:
     * - realizadas pelo médico
     * - e do centro associado ao médico
     */
    if ($user->isMedico()) {

        $medico = $user->medico;

        $query->where('medico_id', $medico->id)
              ->where('centro_id', $medico->centro_id);
    }

    /**
     * 🔹 Se for CENTRO
     * Lista todas as doações do centro
     */
    elseif ($user->isCentro()) {

        $centro = $user->centro;

        $query->where('centro_id', $centro->id);
    }

    /**
     * 🔹 Se for DOADOR
     * Lista todas as doações feitas pelo doador
     */
   elseif ($user->isDoador()) { 

    $query->whereHas('agendamento', function ($q) use ($user) {

        $q->where('user_id', $user->id);

    });
}

    /**
     * 🔹 Admin vê tudo
     */
    elseif ($user->isAdmin()) {
        // sem filtros
    }

    /**
     * 🔹 Segurança extra
     */
    else {
        abort(403, 'Acesso não autorizado.');
    }

    $doacoes = $query
        ->latest()
        ->paginate(10);

    return view('doacoes.index', compact('doacoes'));
}

    /**
     * 🔹 Formulário de criação
     */
    public function create_nao()
    {
        $user = Auth::user();

        if (!$user->medico) {
            return redirect()->back()->with('error', '⚠️ Apenas médicos podem registrar doações.');
        }

        $agendamentos = Agendamento::with(['doador.user'])->get();

        return view('doacoes.create', compact('agendamentos'));
    }

    /**
     * 🔹 Armazenar nova doação
     */
    public function store_nao(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user->medico) {
                return redirect()->back()->with('error', '🚫 Apenas médicos podem registrar doações.');
            }

            $validated = $request->validate([
                'agendamento_id' => 'required|exists:agendamentos,id',
                'data_doacao'    => 'required|date',
                'tipo_doacao'    => 'required|string|max:50',
                'status'         => 'nullable|in:Concluída,Pendente,Cancelada',
                'observacao'     => 'nullable|string|max:1000',
                'volume_ml'      => 'nullable|integer|min:0',
                'estado'         => 'nullable|in:coletada,em_teste,aprovada,rejeitada,processada',
            ]);

            // Preenche campos automáticos
            $validated['medico_id'] = $user->medico->id;
            $validated['centro_id'] = $user->medico->centro_id;

            Doacao::create($validated);

            return redirect()->route('doacoes.index')
                ->with('success', '✅ Doação registrada com sucesso!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', '⚠️ Corrija os erros e tente novamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', '💥 Erro ao registrar doação: ' . $e->getMessage());
        }
    }


    public function create(Request $request)
{
    $user = Auth::user();

    if (!$user->medico) {

        return redirect()->back()
            ->with('error', 'Apenas médicos podem registrar doações.');
    }

    $agendamentos = Agendamento::with([
        'doador.user'
    ])
    ->where('status', 'confirmado')
    ->get();

    $agendamentoSelecionado = $request->agendamento_id;

    return view(
        'doacoes.create',
        compact(
            'agendamentos',
            'agendamentoSelecionado'
        )
    );
}


public function store(Request $request)
{
    $user = Auth::user();

    if (!$user->medico) {

        return back()->with(
            'error',
            'Apenas médicos podem registrar doações.'
        );
    }

    $validated = $request->validate([

        'agendamento_id' => 'required|exists:agendamentos,id',

        'data_doacao' => 'required|date',

        'tipo_doacao' => 'required|string|max:50',

        'volume_ml' => 'required|integer|min:100|max:1000',

        'estado' => 'required|in:coletada,em_teste,aprovada,rejeitada,processada',

        'status' => 'required|in:Concluída,Pendente,Cancelada',

        'observacao' => 'nullable|string|max:1000',

    ]);

    $doacaoExiste = Doacao::where(
        'agendamento_id',
        $request->agendamento_id
    )->exists();

    if ($doacaoExiste) {

        return back()->with(
            'error',
            'Este agendamento já possui uma doação registrada.'
        );
    }

    $validated['medico_id'] = $user->medico->id;

    $validated['centro_id'] = $user->medico->centro_id;

    Doacao::create($validated);

    return redirect()
        ->route('doacoes.index')
        ->with(
            'success',
            'Doação registrada com sucesso.'
        );
}


    /**
     * 🔹 Exibir detalhes da doação
     */
    public function show(Doacao $doacao)
    {
        $doacao->load(['medico.user', 'centro', 'agendamento.doador.user']);
        return view('doacoes.show', compact('doacao'));
    }

    /**
     * 🔹 Formulário de edição
     */
    public function edit(Doacao $doacao)
    {
        $user = Auth::user();

        if (!$user->medico) {
            return redirect()->back()->with('error', '⚠️ Apenas médicos podem editar doações.');
        }

        if ($doacao->centro_id != $user->medico->centro_id) {
            return redirect()->back()->with('error', '🚫 Você não pode editar doações de outro centro.');
        }

        return view('doacoes.edit', compact('doacao'));
    }

    /**
     * 🔹 Atualizar doação
     */
    public function update(Request $request, Doacao $doacao)
    {
        try {
            $user = Auth::user();

            if (!$user->medico) {
                return redirect()->back()->with('error', '⚠️ Apenas médicos podem atualizar doações.');
            }

            if ($doacao->centro_id != $user->medico->centro_id) {
                return redirect()->back()->with('error', '🚫 Você não pode editar doações de outro centro.');
            }

            $validated = $request->validate([
                'status'     => 'required|in:Concluída,Pendente,Cancelada',
                'estado'     => 'required|in:coletada,em_teste,aprovada,rejeitada,processada',
                'observacao' => 'nullable|string|max:1000',
            ]);

            $doacao->update($validated);

            return redirect()->route('doacoes.index')
                ->with('success', '✅ Doação atualizada com sucesso!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', '⚠️ Corrija os erros e tente novamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', '💥 Erro ao atualizar doação: ' . $e->getMessage());
        }
    }

    /**
     * 🔹 Excluir doação
     */
    public function destroy(Doacao $doacao)
    {
        try {
            $user = Auth::user();

            if (!$user->medico) {
                return redirect()->back()->with('error', '⚠️ Apenas médicos podem excluir doações.');
            }

            if ($doacao->centro_id != $user->medico->centro_id) {
                return redirect()->back()->with('error', '🚫 Você não pode excluir doações de outro centro.');
            }

            $doacao->delete();

            return redirect()->route('doacoes.index')
                ->with('success', '🗑️ Doação removida com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', '💥 Erro ao excluir: ' . $e->getMessage());
        }
    }
}
