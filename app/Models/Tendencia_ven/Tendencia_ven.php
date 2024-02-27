<?php

namespace App\Models\Tendencia_ven;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tendencia_ven extends Model
{
    use HasFactory;
    public $timestamps = true;      //Activar las funcion de guardar la fecha automaticamente
    protected $table = 'tendencia_ven';
    protected $primaryKey = 'id';

    protected $fillable = [

        'id',
        'fecha',
        'descripcion_tend',
        'observacion',
        'id_informacion',
        'tendencia_actual',
        'id_tendencia',
        'posicion',
        'link',
        'id_estatus',

    ];



    /**
     * Relciona el modelo Visitante con el modelo informacion para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function informacion()
    {
        return $this->belongsTo('\App\Models\Administracion\Informacion', 'id_informacion', 'id_informacion');
    }

    /**
     * Relciona el modelo Visitante con el modelo tendencia para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tendencia()
    {
        return $this->belongsTo('\App\Models\Administracion\Tendencia', 'id_tendencia', 'id_tendencia');
    }

    /**
     * Relciona el modelo Visitante con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }

}
