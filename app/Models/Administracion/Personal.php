<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'personal';
    protected $primaryKey = 'id_personal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ci',
        'nombre',
        'apellido',
        'nro_empleado',
        'id_gerencia',
        'id_estatus',
        'id_cargo',
    ];


    /**
     * Relciona el modelo Personal con el modelo Estatus para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Estatus()
    {
        return $this->belongsTo('\App\Models\Administracion\Estatus', 'id_estatus', 'id_estatus');
    }

    /**
     * Relciona el modelo Personal con el modelo Gerencia para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gerencia()
    {
        return $this->belongsTo('\App\Models\Administracion\Gerencia', 'id_gerencia', 'id_gerencia');
    }

    /**
     * Relciona el modelo Personal con el modelo Cargo para transacciones con Eloquent
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cargo()
    {
        return $this->hasOne('\App\Models\Administracion\Cargo', 'id_cargo', 'id_cargo');
    }


    public function registro()
    {
        return $this->hasMany('\App\Models\Registro\Registro', 'id_personal', 'id_personal');
    }


}
