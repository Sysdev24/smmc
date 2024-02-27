<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiones extends Model
{
    use HasFactory;

    protected $table = 'regiones';
    protected $primaryKey = 'id_regiones';

    protected $fillable = [
        'id_regiones',
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
