<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campanha;
class Centro extends Model
{
    use HasFactory;

    protected $table = 'centros';

    /**
     * Atributos que podem ser atribuídos em massa (mass assignment).
     */
    protected $fillable = [
        'user_id',
        'nome_centro',
        'telefone',
        'email',
        'responsavel',
        'alvara',
        'licenca',
        'nif',
        'imagem',
        'latitude',
        'longitude',
        //'ativo'
    ];

    /**
     * Conversão de tipos para atributos.
     */
    protected $casts = [
       // 'ativo' => 'boolean',
        'validade_alvara' => 'date'
    ];

    /**
     * Relacionamento com o usuário.
     * Um centro pertence a um usuário.
     */// 🔹 Relacionamento com Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔹 Relacionamento com Endereço
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    

public function campanhas()
{ 
    return $this->hasMany(Campanha::class);
}
}
