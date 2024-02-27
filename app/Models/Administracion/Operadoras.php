<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operadoras extends Model
{
    use HasFactory;

    protected $table = 'operadoras';
    protected $primaryKey = 'id_operadora';

    protected $fillable = [
        'descripcion',
        'id_estatus',
    ];

    /**
     * Relciona el modelo Operadoras con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
*/
    public function estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }
     
}
