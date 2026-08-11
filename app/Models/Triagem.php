<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triagem extends Model
{
    use HasFactory;
    protected $table="triagens";
    protected $fillable = [
        'doador_id',
        'apto',
        'agendamento_id',
        'medico_id',
        'observacoes',
        'pressao_arterial',
        'temperatura',
        'frequencia_cardiaca',
        'peso',
        'altura',
        'motivo_inapto',
        'centro_id',
    ];

    // RELACIONAMENTOS
    public function doador()
    {
        return $this->belongsTo(Doador::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}
