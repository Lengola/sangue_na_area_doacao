<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Endereco;

class UserController extends Controller
{

     public function index()
    {
        $users = User::latest()->paginate(10)  ;

        return view('users.index', compact('users'));
    }




    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // 🔹 Atualiza apenas campos enviados do usuário
        $dadosUser = $request->only([
            'name',
            'email',
            'role',
            'ativo',
            'password'
        ]);

        // Remove campos vazios (evita sobrescrever com null)
        $dadosUser = array_filter($dadosUser, fn($value) => !is_null($value) && $value !== '');
        // Se vier password, criptografa
        // 🔹 Senha
    if (!empty($dadosUser['password'])) {
        $dadosUser['password'] = bcrypt($dadosUser['password']);
    } else {
        unset($dadosUser['password']);
    }


        $user->update($dadosUser);

        // 🔹 Atualizar endereço (se existir)
        $dadosEndereco = $request->only([
    'cidade',
    'provincia',
    'pais',
    'latitude',
    'longitude'
]);


if ($request->hasFile('profile_photo')) {

    // apagar imagem antiga (opcional)
    if ($user->profile_photo_path) {
        \Storage::delete('public/' . $user->profile_photo_path);
    }

    // guardar nova imagem
    $path = $request->file('profile_photo')->store('profile_photos', 'public');

    // salvar no banco
    $user->profile_photo_path = $path;
}

// ⚠️ garante que salva tudo
$user->save();

$dadosEndereco = array_filter($dadosEndereco, fn($value) => !is_null($value) && $value !== '');

if (!empty($dadosEndereco)) {
    if ($user->endereco) {
        $user->endereco->update($dadosEndereco);
    } else {
        $endereco = Endereco::create($dadosEndereco);
        $user->endereco_id = $endereco->id;
        $user->save();
    }

            //$user->endereco->update($dadosEndereco);
        }

        return redirect()->back()->with('success', 'Usuário atualizado com sucesso!');
        }

}