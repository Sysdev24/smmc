<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VInformacion extends Model
{
    use HasFactory;

    protected $table = 'view_informacion';
    protected $primaryKey = 'id_informacion';

    protected $fillable = [
        'id_informacion',
        'informacion',
        'id_tipo_informacion',
        'tipo_informacion',


    ];
 /**
     * Relaciona el modelo estatus con el modelo Estatus para las relaciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function informacion()
    {
        return $this->belongsTo('\App\Models\Administracion\Informacion', 'id_informacion', 'id_informacion');
    }


}
