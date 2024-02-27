<?php

use App\Models\Registro\Registro;
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
 Route::get('registro', function () {
$data =DB::table('registro');

    $data = $data->select(['registro.id_registro',
    'registro.id_estatus as estatus_registro',
                                   'personal.id_personal',
                                   'personal.ci',
                                   'personal.nombre',
                                   'personal.apellido',
                                   'personal.nro_empleado',
                                   'cargo.descripcion as cargo',
                                   'gerencia.descripcion as gerencia',
                                   'estados.descripcion as estado',
                                   'operadoras.descripcion as operadora',
                                   'plan.descripcion as plan',
                                   'plan.monto_credito as monto_plan',
                                   'estatus.descripcion as estatus',
                                   'registro.nro_tlf',
                                   'registro.cuenta_uso',
                                   'registro.observacion',
								   'equipo.descripcion as equipo'
                                ]);
    $data = $data->leftjoin('personal', 'personal.id_personal','registro.id_personal' );
    $data = $data->leftjoin('plan', 'plan.id_plan', 'registro.id_plan');
    $data = $data->leftjoin('operadoras', 'operadoras.id_operadora', 'registro.id_operadora');
    $data = $data->leftjoin('estatus', 'estatus.id_estatus', 'registro.id_estatus');
    $data = $data->leftjoin('estados', 'estados.id_estado', 'personal.id_estado');
    $data = $data->leftjoin('gerencia', 'gerencia.id_gergral', 'personal.id_gergral');
    $data = $data->leftjoin('cargo', 'cargo.id_cargo', 'personal.id_cargo');
	$data = $data->leftjoin('equipo', 'equipo.id_sede_equipo', 'registro.id_sede_equipo');
    $data = $data->get();
    return compact('data');
});


/* Route::get('registro', function () {
    $data = ViewRegistro::all();
    return compact('data');
});*/


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

Route::get('plan', function () {
    $data = Plan::where ('id_estatus','1')->get ();
    return compact('data');
}); //->middleware('auth');

/*Route::get('registro', function () {
    $data = Registro::all();
    return compact('data');
});*/

Route::get('personal', function () {
    //dd('estoy aqui');
    $data = Personal::where ('id_estatus', '1')
    ->with(['cargo', 'gerencia','estado','Estatus'])
    ->get();
    //dd($data[0]->cargo->descripcion);
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
