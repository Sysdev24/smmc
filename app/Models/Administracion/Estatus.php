<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    use HasFactory;

    protected $table = 'estatus';
    protected $primaryKey = 'id_estatus';

    protected $fillable = [
        'id_estatus',
        'siglas',
        'descripcion',
    ];



}
