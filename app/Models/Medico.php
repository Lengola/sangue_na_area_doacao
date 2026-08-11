<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
   use HasFactory;

     protected $fillable = [
        'user_id',
        'especialidade',
        'numero_ordem',
        'telefone',
        'centro_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
public function getNomeAttribute()
{
    return $this->user?->name ?? 'Sem nome';
}


    // 🔹 Um médico pertence a um centro de saúde
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}
