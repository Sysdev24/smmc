<?php

namespace App\Models\Monitoreo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitoreo extends Model
{
    use HasFactory;
    public $timestamps = true;      //Activar las funcion de guardar la fecha automaticamente
    protected $table = 'monitoreo';
    protected $primaryKey = 'id_monitoreo';

    protected $fillable = [

		'id_monitoreo',
        'fecha',
        'id_personal',
        'tipo_informacion',
        'informacion',
        'descripcion',
        'link',
        'insumo',
        'regiones',
        'estado',
        'tendencia',
        'tipo_evento',
        'id_estatus',


    ];

    /**
     * Relciona el modelo Visitante con el modelo personal para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personal()
    {
        return $this->belongsTo('\App\Models\Administracion\Personal', 'id_personal', 'id_personal');
    }

    /**
     * Relciona el modelo Visitante con el modelo tipo_informacion para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_informacion()
    {
        return $this->belongsTo('\App\Models\Administracion\Tipo_informacion', 'id_tipo_informacion', 'id_tipo_informacion');
    }


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

    /**
     * Relciona el modelo Visitante con el modelo insumo para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function insumo()
    {
        return $this->belongsTo('\App\Models\Administracion\Insumo', 'id_insumo', 'id_insumo');
    }
      /**
     * Relciona el modelo Visitante con el modelo regiones  para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function regiones ()
    {
        return $this->belongsTo('\App\Models\Administracion\Regiones ', 'id_regiones', 'id_regiones');
    }
        /**
     * Relciona el modelo Visitante con el modelo tipo evento para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function estados ()
    {
        return $this->belongsTo('\App\Models\Administracion\Estado', 'id_estado', 'id_estado');
    }
      /**
     * Relciona el modelo Visitante con el modelo tipo evento para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function tipo_evento ()
    {
        return $this->belongsTo('\App\Models\Administracion\Tipo_evento ', 'id_tipo_evento', 'id_tipo_evento');
    }
}
