<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sangue extends Model
{
    use HasFactory;

    protected $fillable = [
        'doacao_id',
        'doador_id',
        'codigo_bolsa',
        'data_coleta',
        'volume_ml',
        'data_validade',
        'status',
        'tipo_sanguineo',
        'hiv',
        'hepatite_b',
        'hepatite_c',
        'sifilis',
        'malaria',
        'centro_id',
    ];

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}
