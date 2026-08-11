<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    use HasFactory;
protected $table="notificacoes";
    protected $fillable = [
        'user_id',
        'titulo',
        'mensagem',
        'canal',
        'centro_id',
        'lida',
        'enviada_em',
    ];

    protected $casts = [
        'lida' => 'boolean',
        'enviada_em' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}
