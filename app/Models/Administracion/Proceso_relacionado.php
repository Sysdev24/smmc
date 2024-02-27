<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso_relacionado extends Model
{
    use HasFactory;

    protected $table = 'proceso_relacionado';
    protected $primaryKey = 'id_proceso_relacionado';

    protected $fillable = [
        'id_proceso_relacionado',
        'descripcion',
        'id_estatus',

    ];
 /**
     * Relaciona el modelo estatus con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estatus()
    {
        return $this->hasMany('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }


}
