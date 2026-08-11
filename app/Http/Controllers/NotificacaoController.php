<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use App\Models\Centro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacaoController extends Controller
{
    /**
     * Exibe todas as notificações.
     */
    public function index()
    {
        // Se for um usuário comum, filtra apenas as notificações do seu centro
        $user = Auth::user();

        $query = Notificacao::with('centro', 'user')->latest();

        if ($user->centro_id) {
            $query->where('centro_id', $user->centro_id);
        }

        $notificacoes = $query->get();

        return view('notificacoes.index', compact('notificacoes'));
    }

    /**
     * Mostra o formulário de criação de uma nova notificação.
     */
    public function create()
    {
        $centros = Centro::orderBy('nome_centro')->get();
        return view('notificacoes.create', compact('centros'));
    }

    /**
     * Armazena uma nova notificação no banco.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'mensagem' => 'required|string',
            'canal' => 'required|in:email,sms,app',
            'centro_id' => 'required|exists:centros,id',
        ]);

        $notificacao = new Notificacao();
        $notificacao->user_id = Auth::id();
        $notificacao->titulo = $request->titulo;
        $notificacao->mensagem = $request->mensagem;
        $notificacao->canal = $request->canal;
        $notificacao->centro_id = $request->centro_id;
        $notificacao->lida = false;
        $notificacao->save();

        return redirect()->route('notificacoes.index')->with('success', '✅ Notificação criada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma notificação específica.
     */
    public function show(Notificacao $notificaco)
    {
        // Marca como lida ao visualizar
        if (!$notificaco->lida) {
            $notificaco->update(['lida' => true]);
        }

        return view('notificacoes.show', compact('notificaco'));
    }

    /**
     * Mostra o formulário de edição.
     */
    public function edit(Notificacao $notificaco)
    {
        $centros = Centro::orderBy('nome_centro')->get();
        return view('notificacoes.edit', compact('notificaco', 'centros'));
    }

    /**
     * Atualiza uma notificação existente.
     */
    public function update(Request $request, Notificacao  $notificaco)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'mensagem' => 'required|string',
            'canal' => 'required|in:email,sms,app',
            'centro_id' => 'required|exists:centros,id',
        ]);

        $notificaco->update([
            'titulo' => $request->titulo,
            'mensagem' => $request->mensagem,
            'canal' => $request->canal,
            'centro_id' => $request->centro_id,
            'lida' => $request->has('lida'),
        ]);

        return redirect()->route('notificacoes.index')->with('success', '✏️ Notificação atualizada com sucesso!');
    }

    /**
     * Exclui uma notificação.
     */
    public function destroy(Notificacao $notificaco)
    {
        $notificaco->delete();

        return redirect()->route('notificacoes.index')->with('success', '🗑️ Notificação excluída com sucesso!');
    }
}
