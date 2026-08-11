<?php

namespace App\Http\Controllers;

use App\Models\Sangue;
use App\Models\Centro;
use Illuminate\Http\Request;

class SangueController extends Controller
{
    /**
     * Mostrar lista de bolsas de sangue.
     */
    
    public function index()
{
    $userId = auth()->id();

    $sangues = Sangue::with('centro')
        ->whereHas('centro', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->latest()
        ->paginate(10);

    return view('sangues.index', compact('sangues'));
}
    
    public function index1()
    {
        $sangues = Sangue::with('centro')->latest()->paginate(10);
        return view('sangues.index', compact('sangues'));
    }



    /**
     * Mostrar formulário de criação.
     */
    public function create()
    {
        $centros = Centro::orderBy('nome_centro')->get();
        return view('sangues.create', compact('centros'));
    }

    /**
     * Armazenar nova bolsa no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_bolsa' => 'required|string|max:255|unique:sangues',
            'tipo_sanguineo' => 'required',
            'centro_id' => 'required|exists:centros,id',
            'status' => 'required',
        ]);

        $sangue = new Sangue();
        $sangue->codigo_bolsa = $request->codigo_bolsa;
        $sangue->tipo_sanguineo = $request->tipo_sanguineo;
        $sangue->volume_ml = $request->volume_ml;
        $sangue->data_coleta = $request->data_coleta;
        $sangue->data_validade = $request->data_validade;
        $sangue->status = $request->status;
        $sangue->centro_id = $request->centro_id;
        $sangue->hiv = $request->hiv ?? false;
        $sangue->hepatite_b = $request->hepatite_b ?? false;
        $sangue->hepatite_c = $request->hepatite_c ?? false;
        $sangue->sifilis = $request->sifilis ?? false;
        $sangue->malaria = $request->malaria ?? false;

        $sangue->save();

        return redirect()->route('sangues.index')->with('success', 'Bolsa de sangue registrada com sucesso!');
    }

    /**
     * Mostrar detalhes de uma bolsa.
     */
    public function show($id)
    {
        $sangue = Sangue::with('centro')->findOrFail($id);
        return view('sangues.show', compact('sangue'));
    }

    /**
     * Mostrar formulário de edição.
     */
    public function edit($id)
    {
        $sangue = Sangue::findOrFail($id);
        $centros = Centro::orderBy('nome_centro')->get();
        return view('sangues.edit', compact('sangue', 'centros'));
    }

    /**
     * Atualizar uma bolsa existente.
     */
    public function update(Request $request, $id)
    {
        $sangue = Sangue::findOrFail($id);

        $request->validate([
            'codigo_bolsa' => 'required|string|max:255|unique:sangues,codigo_bolsa,' . $sangue->id,
            'tipo_sanguineo' => 'required',
            'centro_id' => 'required|exists:centros,id',
            'status' => 'required',
        ]);

        $sangue->update([
            'codigo_bolsa' => $request->codigo_bolsa,
            'tipo_sanguineo' => $request->tipo_sanguineo,
            'volume_ml' => $request->volume_ml,
            'data_coleta' => $request->data_coleta,
            'data_validade' => $request->data_validade,
            'status' => $request->status,
            'centro_id' => $request->centro_id,
            'hiv' => $request->hiv ?? false,
            'hepatite_b' => $request->hepatite_b ?? false,
            'hepatite_c' => $request->hepatite_c ?? false,
            'sifilis' => $request->sifilis ?? false,
            'malaria' => $request->malaria ?? false,
        ]);

        return redirect()->route('sangues.index')->with('success', 'Bolsa atualizada com sucesso!');
    }

    /**
     * Eliminar uma bolsa.
     */
    public function destroy($id)
    {
        $sangue = Sangue::findOrFail($id);
        $sangue->delete();

        return redirect()->route('sangues.index')->with('success', 'Bolsa eliminada com sucesso!');
    }
}
