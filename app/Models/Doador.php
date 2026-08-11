<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doador extends Model
{
    use HasFactory;

    protected $table = 'doadores';

    /**
     * Os atributos que podem ser atribuídos em massa.
     */

    protected $fillable = [
        'user_id',
        'data_nascimento',
        'sexo',
        'numero_identificacao',
        'tipo_sanguineo',
        'ultimo_agendamento',
        'telefone',
        'peso',
        'observacoes',

    ];

    /**
     * Casts para tipos específicos.
     */
    protected $casts = [
        'data_nascimento' => 'date',
        'ultimo_agendamento' => 'datetime',
        'peso' => 'decimal:2',
       // 'ativo' => 'boolean',

    ];

    /**
     * Relacionamento com User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Escopo para doadores ativos.
     */
   public function Ativos($query)
{
    return $query->whereHas('user', function ($q) {
        $q->where('ativo', true);
    });
}



    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 🔹 Relacionamento: um doador pode ter vários agendamentos
     * (caso implementes a tabela de agendamentos)
     */
    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

    /**
     * 🔹 Retorna o nome do doador (vindo do usuário)
     */
    public function getNomeAttribute()
    {
        return $this->usuario ? $this->usuario->name : 'Sem nome';
    }

    /**
     * 🔹 Escopo local para buscar doadores por tipo sanguíneo
     */
    public function scopeTipoSanguineo($query, $tipo)
    {
        return $query->where('tipo_sanguineo', $tipo);
    }

    /**
     * 🔹 Escopo local para buscar doadores por cidade (via relação com User e Endereço)
     */
    public function scopePorCidade($query, $cidade)
    {
        return $query->whereHas('usuario.endereco', function ($q) use ($cidade) {
            $q->where('cidade', 'like', "%{$cidade}%");
        });
    }
}
