<?php

namespace App\Models\Visitantes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitante extends Model
{
    use HasFactory;
    public $timestamps = true;      //Activar las funcion de guardar la fecha automaticamente
    protected $table = 'registro';
    protected $primaryKey = 'id_registro';

    protected $fillable = [

		'id_personal',
        'id_operadora ',
        'id_plan',
        'nro_tlf',
        'cuenta_uso',
        'id_estatus',
        'observacion',
       

    ];

    /**
     * Relciona el modelo Visitante con el modelo Personal para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personal()
    {
        return $this->belongsTo('\App\Models\Administracion\Personal', 'id_personal', 'id_personal');
    }


    /**
     * Relciona el modelo Visitante con el modelo Operadora para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operadora()
    {
        return $this->belongsTo('\App\Models\Administracion\Operadoras', 'id_operadora', 'id_operadora');
    }

    /**
     * Relciona el modelo Visitante con el modelo Plan para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo('\App\Models\Administracion\Plan', 'id_plan', 'id_plan');
    }

    /**
     * Relciona el modelo Visitante con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }
    public function cargo()
    {
        return $this->belongsTo('\App\Models\Administracion\Cargo', 'id_cargo', 'id_cargo');
    }

}
