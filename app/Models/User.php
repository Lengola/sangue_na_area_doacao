<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'ativo',
        'endereco_id',
        'profile_photo_path',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



public function isAdmin()
{
    return $this->role === 'admin' ;
}

public function isMedico()
{
    return $this->role === 'medico' ;
}

public function isDoador()
{
    return $this->role === 'doador';
}

public function isCentro()
{
    return $this->role === 'centro';
}


// 🔹 Relacionamento com Endereço
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    // 🔹 Relacionamento com Doador
    public function doador()
    {
        return $this->hasOne(Doador::class);
    }

    // 🔹 Relacionamento com Centro
    public function centro()
    {
        return $this->hasOne(Centro::class);
    }

    public function medico()
{
    return $this->hasOne(Medico::class, 'user_id');
}

    public function isAtivo()
    {
        return $this->ativo === true;
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }


}
