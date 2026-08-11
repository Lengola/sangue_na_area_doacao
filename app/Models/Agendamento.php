<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'centro_id',
        'campanha_id',
        'data_agendamento',
        'hora_agendada',
        'status',
        'motivo_cancelamento',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }


    // ✅ Adiciona isto
    public function doador()
    {
        return $this->belongsTo(Doador::class, 'user_id', 'user_id');
    }

    public function doacao()
{
    return $this->hasOne(Doacao::class);
}

}
