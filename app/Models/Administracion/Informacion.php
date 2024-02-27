<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    use HasFactory;

    protected $table = 'informacion';
    protected $primaryKey = 'id_informacion';

    protected $fillable = [
        'id_informacion',
        'id_tipo_informacion',
        'descripcion',
        'id_estatus',

    ];
 /**
     * Relaciona el modelo informacion con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estatus()
    {
        return $this->hasMany('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }
     /**
     * Relciona el modelo informacion con el modelo tipo_informacion para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_informacion()
    {
        return $this->belongsTo('\App\Models\Administracion\Tipo_informacion', 'id_tipo_informacion', 'id_tipo_informacion');
    }


}
