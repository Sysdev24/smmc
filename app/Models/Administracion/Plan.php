<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plan';
    protected $primaryKey = 'id_plan';

    protected $fillable = [
        'descripcion',
		'monto_credito',
        'id_estatus',

		
    ];

    /**
     * Relciona el modelo Plan con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	*/
    public function estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }
	     
}