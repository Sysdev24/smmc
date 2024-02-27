<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gerencia extends Model
{
    use HasFactory;

    protected $table = 'gerencia';
    protected $primaryKey = 'id_gerencia';

    protected $fillable = [
        'descripcion',
        'id_estatus',
    ];

    /**
     * Relciona el modelo gerencia con el modelo estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function estatus()
     {
         return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
     }

}
