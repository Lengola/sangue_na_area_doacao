<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    use HasFactory;

    /**
     * 🔹 Nome da tabela
     */
    protected $table = 'doacoes';

    /**
     * 🔹 Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'agendamento_id',
        'data_doacao',
        'tipo_doacao',
        'status',
        'observacao',
        'volume_ml',
        'estado',
        'medico_id',
        'centro_id',
        'observacoes',
    ];

    /**
     * 🔹 Conversão automática de tipos
     */
    protected $casts = [
        'data_doacao' => 'date',
        'volume_ml'   => 'integer',
    ];

    /**
     * 🔹 Relacionamento: Doação pertence a uma Triagem
     */
    public function triagem()
    {
        return $this->belongsTo(Triagem::class, 'triagen_id');
    }

    /**
     * 🔹 Relacionamento: Doação pertence a um Agendamento
     */
    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    /**
     * 🔹 Relacionamento: Doação pertence a um Médico
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    /**
     * 🔹 Relacionamento: Doação pertence a um Centro de Saúde
     */
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    /**
     * 🔹 Acessor opcional — retorna o nome do médico responsável
     */
    public function getNomeMedicoAttribute()
    {
        return $this->medico?->user?->name ?? '—';
    }

    /**
     * 🔹 Acessor opcional — retorna o nome do doador
     */
    public function getNomeDoadorAttribute()
    {
        return $this->agendamento?->doador?->user?->name ?? '—';
    }

    /**
     * 🔹 Escopo: retorna apenas doações ativas/concluídas
     */
    public function scopeAtivas($query)
    {
        return $query->where('status', 'Concluída');
    }
}
