<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\Centro;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CampanhaController extends Controller
{
    /**
     * Lista todas as campanhas.
     */
///////////////////////////////////////////////////////////

     public function index_centro()
    {
        $campanhas = Campanha::with('centro')
            ->whereDate('data_fim', '>=', Carbon::today())
            ->orderBy('data_inicio')
            ->paginate(9);

        return view('campanhas.index_centro', compact('campanhas'));
    }

    public function show_centro(Campanha $campanha)
    {
        return view('campanhas.show_centro', compact('campanha'));
    }

///////////////////////////////////////////////////////////
    public function index()
    {
        // Mostra apenas campanhas do centro do usuário (se aplicável)
        $user = Auth::user();

        $campanhas = Campanha::with('centro')
            ->when($user && isset($user->centro_id), function ($query) use ($user) {
                $query->where('centro_id', $user->centro_id);
            })
            ->latest()
            ->paginate(10);

        return view('campanhas.index', compact('campanhas'));
    }

    /**
     * Mostra o formulário de criação.
     */
    public function create()
    {
        $centros = Centro::all(); // Lista de centros para o select
        return view('campanhas.create', compact('centros'));
    }

    /**
     * Armazena uma nova campanha no banco.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'       => 'required|string|max:255',
            'descricao'    => 'nullable|string',
            'local'        => 'nullable|string|max:255',
            'data_inicio'  => 'nullable|date',
            'data_fim'     => 'nullable|date|after_or_equal:data_inicio',
            'centro_id'    => 'nullable|exists:centros,id',
        ]);

        // Se o usuário tem centro vinculado, define automaticamente
        if (Auth::check() && Auth::user()->centro_id) {
            $validated['centro_id'] = Auth::user()->centro_id;
        }

        Campanha::create($validated);

        return redirect()->route('campanhas.index')
            ->with('success', '✅ Campanha criada com sucesso!');
    }

    /**
     * Mostra uma campanha específica.
     */
    public function show(Campanha $campanha)
    {
        return view('campanhas.show', compact('campanha'));
    }

    /**
     * Mostra o formulário de edição.
     */
    public function edit(Campanha $campanha)
    {
        $centros = Centro::all();
        return view('campanhas.edit', compact('campanha', 'centros'));
    }

    /**
     * Atualiza uma campanha.
     */
    public function update(Request $request, Campanha $campanha)
    {
        $validated = $request->validate([
            'titulo'       => 'required|string|max:255',
            'descricao'    => 'nullable|string',
            'local'        => 'nullable|string|max:255',
            'data_inicio'  => 'nullable|date',
            'data_fim'     => 'nullable|date|after_or_equal:data_inicio',
            'centro_id'    => 'nullable|exists:centros,id',
        ]);

        if (Auth::check() && Auth::user()->centro_id) {
            $validated['centro_id'] = Auth::user()->centro_id;
        }

        $campanha->update($validated);

        return redirect()->route('campanhas.index')
            ->with('success', '✏️ Campanha atualizada com sucesso!');
    }

    /**
     * Remove uma campanha (soft delete).
     */
    public function destroy(Campanha $campanha)
    {
        $campanha->delete();

        return redirect()->route('campanhas.index')
            ->with('success', '🗑️ Campanha excluída com sucesso!');
    }
}
