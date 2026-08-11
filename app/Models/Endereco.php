<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable = [
        'cidade', 'provincia', 'pais', 'latitude', 'longitude'
    ];

     // Relacionamento 1:N (um endereço pode pertencer a vários usuários)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relacionamento 1:N (um endereço pode ter vários centros)
    public function centros()
    {
        return $this->hasMany(Centro::class);
    }
}
