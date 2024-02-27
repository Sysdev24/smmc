<?php

use App\Models\Monitoreo\Monitoreo;
use App\Models\Administracion\Gerencia;
use App\Models\Administracion\Estatus;
use App\Models\Administracion\Plan;
use App\Models\ViewRegistro;
use App\Models\Administracion\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Administracion\Estado;
use App\Models\Administracion\Cargo;
use App\Models\Administracion\Roles;
use App\Models\Administracion\Informacion;
use App\Models\Administracion\Insumo;
use App\Models\Administracion\Prioridad;
use App\Models\Administracion\Proceso_relacionado;
use App\Models\Administracion\Redes_sociales;
use App\Models\Administracion\Regiones;
use App\Models\Administracion\Tendencia;
use App\Models\Administracion\Tipo_evento;
use App\Models\Administracion\Tipo_informacion;
use App\Models\Tendencia_ven\Tendencia_ven;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::get('monitoreo', function () {
    $data =DB::table('monitoreo');
    $data = $data->select([     'monitoreo.id_monitoreo',
                                'personal.id_personal as id_personal',
                                'personal.ci as ci',
                                'personal.nombre as nombre',
                                'personal.apellido as apellido',
                                'monitoreo.fecha',
                                'monitoreo.created_at as fecha_emision',
                                'informacion.descripcion as informacion',
                                'tipo_informacion.descripcion as tipo_informacion',
                                'monitoreo.descripcion as observacion',
                                'monitoreo.link',
                                'insumo.descripcion as insumo',
                                'regiones.descripcion as regiones',
                                'estados.descripcion as estado',
                                'tendencia.descripcion as tendencia',
                                'tipo_evento.descripcion as tipo_evento',
                                'estatus.descripcion as estatus'
                            ]);
$data = $data->leftjoin('personal', 'personal.id_personal','monitoreo.id_personal');
$data = $data->leftjoin('informacion','informacion.id_informacion', 'monitoreo.informacion');
$data = $data->leftjoin('tipo_informacion','tipo_informacion.id_tipo_informacion', 'monitoreo.tipo_informacion');
$data = $data->leftjoin('insumo','insumo.id_insumo','monitoreo.insumo');
$data = $data->leftjoin('regiones','regiones.id_regiones','monitoreo.regiones');
$data = $data->leftjoin('estados', 'estados.id_estado', 'monitoreo.estado');
$data = $data->leftjoin('tendencia','tendencia.id_tendencia','monitoreo.tendencia');
$data = $data->leftjoin('tipo_evento','tipo_evento.id_tipo_evento', 'monitoreo.tipo_evento');
$data = $data->leftjoin('estatus', 'estatus.id_estatus', 'monitoreo.id_estatus');
$data = $data->get();

    return compact('data');
});

Route::get('tendencia_ven', function () {
    $data =DB::table('tendencia_ven');
    $data = $data->select([
                               'tendencia_ven.id',
                               'tendencia_ven.fecha',
                               'tendencia_ven.descripcion_tend',
                               'tendencia_ven.observacion',
                               'informacion.descripcion as informacion',
	                           'tendencia_ven.tendencia_actual',
	                           'tendencia.descripcion as tendencia',
                               'tendencia_ven.posicion',
	                           'tendencia_ven.link',
                               'estatus.descripcion as estatus'
                                ]);

$data = $data->leftjoin('informacion','informacion.id_informacion','tendencia_ven.id_informacion');
$data = $data->leftjoin('tendencia','tendencia.id_tendencia','tendencia_ven.id_tendencia');
$data = $data->leftjoin('estatus', 'estatus.id_estatus', 'tendencia_ven.id_estatus');
$data = $data->get();

    return compact('data');
});



Route::get('informacion', function () {
    $data =DB::table('informacion');
    $data = $data->select([
                               'informacion.id_informacion',
                               'informacion.descripcion',
                               'tipo_informacion.descripcion as tipo_informacion',
                               'estatus.descripcion as estatus'
                                ]);

$data = $data->leftjoin('tipo_informacion','tipo_informacion.id_tipo_informacion','informacion.id_tipo_informacion');
$data = $data->leftjoin('estatus', 'estatus.id_estatus', 'informacion.id_estatus');
$data = $data->get();

    return compact('data');
});


Route::get('estados', function () {
    $data = Estado::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('gerencia', function (Request $request) {
    $data = Gerencia::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('estatus', function (Request $request) {
    $data = Estatus::all();
    return compact('data');
});


Route::get('personal', function () {
    $data = Personal::where ('id_estatus', '1')
    ->with(['cargo', 'gerencia','estatus'])
    ->get();
    return  compact('data');
    return response()->json($data);
});

Route::get('cargo', function () {
    $data = Cargo::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('informacion', function () {
    $data = Informacion::where ('id_estatus','1')->get ();
    return compact('data');
});
Route::get('insumo', function () {
    $data = Insumo::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('prioridad', function () {
    $data = Prioridad::where ('id_estatus','1')->get ();
    return compact('data');
});
Route::get('proceso_relacionado', function () {
    $data = Proceso_relacionado::where ('id_estatus','1')->get ();
    return compact('data');
});
Route::get('redes_sociales', function () {
    $data = Redes_sociales::where ('id_estatus','1')->get ();
    return compact('data');
});
Route::get('regiones', function () {
    $data = Regiones::where ('id_estatus','1')->get ();
    return compact('data');
});


Route::get('roles', function () {
    $data = Roles::where ('id_estatus','1')->get ();
    return compact('data');
});
Route::get('tendencia', function () {
    $data = Tendencia::where ('id_estatus','1')->get ();

    return compact('data');
});
Route::get('tipo_evento', function () {
    $data = Tipo_evento::where ('id_estatus','1')->get ();
    return compact('data');
});
Route::get('tipo_informacion', function () {
    $data = Tipo_informacion::where ('id_estatus','1')->get ();
    return compact('data');
});

Route::get('usuario', function () {
    //dd('estoy aqui');
    $data = Personal::where ('id_estatus', '1')
    ->with(['gerencia','roles','Estatus'])
    ->get();
    return  compact('data');
    return response()->json($data);
});

Route::get('usuarios', function () {
    //dd('estoy aqui');
    $data = Personal::where ('id_estatus', '1')
    ->with(['gerencia','estatus'])
    ->get();
    //dd($data);
    return  compact('data');
    return response()->json($data);
});
