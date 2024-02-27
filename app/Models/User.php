<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ci',
        'usuario',
        'password',
        'nombre',
        'apellido',
        'email',
        'id_estatus',
		'id_gerencia',
		'id_roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        /*  'remember_token', */
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        /* 'email_verified_at' => 'datetime', */
    ];

    /**
     * Relciona el modelo User con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }

    /**
     * Relciona el modelo User con el modelo Gerencia para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Gerencia()
    {
        return $this->belongsTo('\App\Models\Administracion\Gerencia', 'id_gergral', 'id_gergral');
    }

    /**
     * Relciona el modelo User con el modelo TipoUsuario para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Roles()
    {
        return $this->belongsTo('\App\Models\Administracion\Roles', 'id_roles', 'id_roles');
    }

}
