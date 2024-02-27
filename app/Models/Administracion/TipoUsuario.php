<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipos_usuarios';
    protected $primaryKey = 'id_tipo_usuario';

    protected $fillable = [
        'descripcion',
        'id_estatus',
    ];

    /**
     * Relaciona el modelo TipoUsuario con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }

    /**
     * Relaciona el modelo User con el modelo TipoUsuario para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany('\App\Models\User', 'id_tipo_usuario', 'id_tipo_usuario');
    }

}
