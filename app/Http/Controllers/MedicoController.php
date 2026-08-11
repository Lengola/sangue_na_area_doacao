<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Endereco;
use App\Models\Medico;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $centro = Auth::user()->centro;

    if (!$centro) {

        return back()->withErrors([
            'centro' => 'Centro não encontrado para este usuário.'
        ]);
    }

    $medicos = Medico::with('user')
        ->whereBelongsTo($centro)
        ->latest()
        ->paginate(10);

    return view('medicos.index', compact('medicos'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $centros = Centro::all();
    return view('medicos.create', compact('centros'));
    }

    /**
     * Store a newly created resource in storage.
     */
     // armazena novo médico + user + endereco
    public function store(Request $request)
    {// dd(Auth::user()->id);
        $validated = $request->validate([
            // dados do usuário
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|min:6',
            'ativo' => 'sometimes|boolean',

            // dados do médico
            'especialidade' => 'required|string|max:150',
            'numero_ordem' => 'required|string|max:50|unique:medicos,numero_ordem',
            'telefone' => 'nullable|string|max:30',
           // 'centro_id' => 'required|exists:centros,id',

            // endereco (obrigatório porque users.endereco_id é FK não-null)
            'cidade' => 'nullable|string|max:120',
            'provincia' => 'nullable|string|max:120',
            'pais' => 'nullable|string|max:120',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            // profile photo
            'profile_photo' => 'nullable|image|max:4096',
        ]);

        DB::beginTransaction();

        try {
            // 1) cria endereco
            $endereco = Endereco::create([
                'cidade' => $validated['cidade'] ?? null,
                'provincia' => $validated['provincia'] ?? null,
                'pais' => $validated['pais'] ?? 'Angola',
                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
            ]);

            // 2) grava foto se enviada
            $profilePath = null;
            if ($request->hasFile('profile_photo')) {
                $profilePath = $request->file('profile_photo')->store('profiles', 'public');
            }

            // 3) cria user
            $user = User::create([
                'endereco_id' => $endereco->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'] ?? 'm12345678'),
                'role' => 'medico',
                'ativo' => $validated['ativo'] ?? true,
                'profile_photo_path' => $profilePath,
            ]);

            // 4) cria medico
            $medico = Medico::create([
                'user_id' => $user->id,
                'especialidade' => $validated['especialidade'],
                'numero_ordem' => $validated['numero_ordem'],
                'telefone' => $validated['telefone'] ?? null,
                'centro_id' => Auth::user()->centro->id
,
            ]);

            DB::commit();

            return redirect()->route('medicos.index')->with('success', 'Médico cadastrado com sucesso!');

        } catch (QueryException $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['database' => 'Erro no banco de dados: ' . $e->getMessage()]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['general' => 'Erro inesperado: ' . $e->getMessage()]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Medico $medico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medico $medico)
    {
        return view('medicos.edit', compact('medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $medico)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $medico->user_id,
            'especialidade' => 'required|string|max:100',
            'numero_ordem' => 'required|string|max:50|unique:medicos,numero_ordem,' . $medico->id,
            'telefone' => 'nullable|string|max:20',
            'bi' => 'nullable|string|max:20'
        ]);

        DB::beginTransaction();

        try {
            $medico->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $medico->update([
                'especialidade' => $request->especialidade,
                'numero_ordem' => $request->numero_ordem,
                'telefone' => $request->telefone,
                'bi' => $request->bi,
                'provincia' => $request->provincia,
                'municipio' => $request->municipio,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            DB::commit();

            return redirect()->route('medicos.index')->with('success', 'Dados atualizados com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico)
    {
        $medico->user->delete(); // Exclui também o usuário
        $medico->delete();
        return redirect()->route('medicos.index')->with('success', 'Médico removido!');
    }
}
