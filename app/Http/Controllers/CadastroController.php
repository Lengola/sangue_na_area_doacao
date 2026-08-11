<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Doador;
use App\Models\Centro;
use App\Models\Endereco;
use App\Models\Medico;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CadastroController extends Controller
{
    //

    /**
     * Exibe o formulário de cadastro.
     */
    public function showForm()
    {
        return view('cadastro'); // Blade com o HTML que você forneceu
    }

    /**
     * Processa o cadastro do usuário (doador ou centro).
     */
    public function store(Request $request)
{// dd($request->all());
    // 🔒 Validação básica do usuário
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:doador,centro',
    ]);

    DB::beginTransaction();

    try {
        // Upload de imagem (perfil ou logotipo)
        $imagemPath = null;
        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('imagens', 'public');
        }

        // Endereço básico
        $request->validate([
            'cidade' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $endereco = Endereco::create([
            'cidade' => $request->cidade,
            'provincia' => $request->provincia,
            'pais' => $request->pais ?? 'Angola',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'endereco_id' => $endereco->id,
            'profile_photo_path' => $imagemPath,
        ]);

        // Caso seja DOADOR
        if ($request->role === 'doador') {
            $request->validate([
                'numero_identificacao' => 'required|string|max:50',
                'data_nascimento' => 'nullable|date',
                'sexo' => 'nullable|in:M,F,O',
                'tipo_sanguineo' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'telefone' => 'nullable|string|max:20',
                'peso_kg' => 'nullable|numeric|min:40',
                'observacoes' => 'nullable|string|max:500',
            ]);

            Doador::create([
                'user_id' => $user->id,
                'numero_identificacao' => $request->numero_identificacao,
                'data_nascimento' => $request->data_nascimento,
                'sexo' => $request->sexo,
                'tipo_sanguineo' => $request->tipo_sanguineo,
                'telefone' => $request->telefone,
                'peso' => $request->peso_kg,
               //'ativo' => true,
                'observacoes' => $request->observacoes,
            ]);
        }

        //  Caso seja CENTRO DE SAÚDE
        if ($request->role === 'centro') {
            $request->validate([
                'nome_centro' => 'required|string|max:255',
                'telefone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'responsavel' => 'nullable|string|max:255',
                'nif' => 'nullable|string|max:100',
            ]);

            Centro::create([
                'user_id' => $user->id,
                'nome_centro' => $request->nome_centro,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'responsavel' => $request->responsavel,
                'nif' => $request->nif,
                'imagem' => $imagemPath,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }

        DB::commit();

        return redirect()->route('dashboard')
            ->with('success', 'Cadastro realizado com sucesso! Seja bem-vindo(a) ' . $request->name . '!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Erro ao cadastrar: ' . $e->getMessage());
    }
}


    public function index()
    {
        // Total de doadores
        $totalDoadores = Doador::count();

        // Doadores ativos
        $doadoresAtivos = Doador::whereHas('user', function ($query) {
    $query->where('ativo', true);
    })->count();


        // Último agendamento (pega o mais recente)
        $ultimoAgendamento = Doador::whereNotNull('ultimo_agendamento')
            ->orderByDesc('ultimo_agendamento')
            ->value('ultimo_agendamento');

        // Distribuição por sexo
        $sexoM = Doador::where('sexo', 'M')->count();
        $sexoF = Doador::where('sexo', 'F')->count();
        $sexoO = Doador::where('sexo', 'O')->count();

        // Distribuição por tipo sanguíneo
        $tipos = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
        $tiposSanguineos = [];
        foreach ($tipos as $tipo) {
            $tiposSanguineos[] = Doador::where('tipo_sanguineo', $tipo)->count();
        }

        // Últimos doadores cadastrados
        $ultimosDoadores = Doador::with('user')
            ->latest()
            ->take(5)
            ->get();
            ///admin
                $usuarios = User::count();
                $centros = Centro::count();
                $medicos = Medico::count();
                $doadores = Doador::count();
            //
        return view('dashboard', compact(
            'totalDoadores',
            'doadoresAtivos',
            'ultimoAgendamento',
            'sexoM',
            'sexoF',
            'sexoO',
            'tiposSanguineos',
            'ultimosDoadores',
            //admin
            'usuarios',
            'centros',
            'medicos'
            ,'doadores'
        ));
    }


}
