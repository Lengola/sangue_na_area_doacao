<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campanha extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'descricao',
        'local',
        'data_inicio',
        'data_fim',
        'centro_id',
    ];

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}
