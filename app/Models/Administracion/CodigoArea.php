<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoArea extends Model
{
    use HasFactory;

    protected $table = 'scv_t_codigos_area';
    protected $primaryKey = 'id_area';

    protected $fillable = [
        'codigo_area',
        'referencia',
        'id_status',
    ];

    /**
     * Relciona el modelo CodigoArea con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_status', 'id_status');
    }
}
