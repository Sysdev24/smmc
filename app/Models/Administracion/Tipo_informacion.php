<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_informacion extends Model
{
    use HasFactory;

    protected $table = 'tipo_informacion';
    protected $primaryKey = 'id_tipo_informacion';

    protected $fillable = [
        'id_tipo_informacion',
        'descripcion',
        'id_estatus',

    ];

    /**
     * Relciona el modelo regiones con el modelo estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function estatus()
     {
         return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
     }

}
