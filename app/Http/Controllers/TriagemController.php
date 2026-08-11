<?php

namespace App\Http\Controllers;

use App\Models\Triagem;
use App\Models\Doador;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TriagemController extends Controller
{
    /**
     * Exibe apenas as triagens do centro do médico logado.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->medico) {//depois tratar isso
            return redirect()->back()->with('error', '⚠️ Apenas médicos podem acessar as triagens.');
        }

        $centroId = $user->medico->centro_id;

        $triagens = Triagem::with(['doador.user', 'medico.user', 'centro', 'agendamento'])
            ->where('centro_id', $centroId)
            ->latest()
            ->get();

        $doadores = Doador::with('user')->get();
        $agendamentos = Agendamento::with('user')->get();

        return view('triagens.index', compact('triagens', 'doadores', 'agendamentos'));
    }

    /**
     * Armazena nova triagem.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->medico) {
            return redirect()->back()->with('error', '⚠️ Apenas médicos podem registrar triagens.');
        }

        $validated = $request->validate([
            'doador_id'         => 'required|exists:doadores,id',
            'agendamento_id'    => 'required|exists:agendamentos,id',
            'pressao_arterial'  => 'nullable|string|max:20',
            'temperatura'       => 'nullable|string|max:10',
            'frequencia_cardiaca' => 'nullable|string|max:10',
            'peso'              => 'nullable|string|max:10',
            'altura'            => 'nullable|string|max:10',
            'apto'              => 'boolean',
            'observacoes'       => 'nullable|string|max:1000',
            'motivo_inapto'     => 'nullable|string|max:1000',
        ]);

        $validated['medico_id'] = $user->medico->id;
        $validated['centro_id'] = $user->medico->centro_id;

        Triagem::create($validated);

        return redirect()
            ->back()
            ->with('success', '✅ Triagem registrada com sucesso!');
    }

    /**
     * Atualiza uma triagem.
     */
public function update(Request $request, Triagem $triagem)
{
    try {
        $user = Auth::user();
      //  dd($triagem->centro_id." | ". $user->medico->centro_id);
        // 🔒 Verifica se o usuário é médico
        if (!$user->medico) {
            return redirect()->back()->with('error', '⚠️ Apenas médicos podem editar triagens.');
        }
        // 🔒 Impede edição de triagens de outro centro
        if ($triagem->centro_id != $user->medico->centro_id) {
            return redirect()->back()->with('error', '🚫 Você não tem permissão para alterar triagens de outro centro.');
        }

        // ✅ Validação completa
        $validated = $request->validate([
            'doador_id'           => 'required|exists:doadores,id',
            'agendamento_id'      => 'required|exists:agendamentos,id',
            'pressao_arterial'    => 'nullable|string|max:20',
            'temperatura'         => 'nullable|string|max:10',
            'frequencia_cardiaca' => 'nullable|string|max:10',
            'peso'                => 'nullable|string|max:10',
            'altura'              => 'nullable|string|max:10',
            'apto'                => 'nullable|boolean',
            'observacoes'         => 'nullable|string|max:1000',
            'motivo_inapto'       => 'nullable|string|max:1000',
        ]);

        // ✅ Converte manualmente o "apto" para booleano
        $validated['apto'] = isset($validated['apto']) && $validated['apto'] == '1';

        // ✅ Define automaticamente o médico e o centro
        $validated['medico_id'] = $user->medico->id;
        $validated['centro_id'] = $user->medico->centro_id;

        // 🩺 Atualiza a triagem com segurança
        $triagem->fill($validated)->save();

        return redirect()
            ->back()
            ->with('success', '✅ Triagem atualizada com sucesso!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // ⚠️ Erros de validação — retorna com mensagens amigáveis
        return redirect()
            ->back()
            ->withErrors($e->validator)
            ->withInput()
            ->with('error', '❌ Erros de validação encontrados. Verifique os campos e tente novamente.');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // 🧱 Triagem não encontrada
        return redirect()
            ->back()
            ->with('error', '⚠️ Triagem não encontrada ou foi removida.');

    } catch (\Exception $e) {
        // 💥 Qualquer outro erro inesperado
        return redirect()
            ->back()
            ->withInput()
            ->with('error', '🚨 Ocorreu um erro ao atualizar a triagem: ' . $e->getMessage());
    }
}


    /**
     * Exclui uma triagem.
     */
    public function destroy(Triagem $triagem)
    {
        $user = Auth::user();

        if (!$user->medico || $triagem->centro_id != $user->medico->centro_id) {
            return redirect()->back()->with('error', '🚫 Você não tem permissão para excluir essa triagem.');
        }

        $triagem->delete();

        return redirect()
            ->back()
            ->with('success', '🗑️ Triagem excluída com sucesso!');
    }
}
