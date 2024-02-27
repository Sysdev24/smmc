<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tendencia extends Model
{
    use HasFactory;

    protected $table = 'tendencia';
    protected $primaryKey = 'id_tendencia';

    protected $fillable = [
        'descripcion',
        'id_estatus',
        'id_tendencia',
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
