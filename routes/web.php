<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
 */

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/monitoreo');
    } else {
        return view('auth/login');
    }
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\Monitoreo\MonitoreoController::class, 'index'])->name('home')->middleware('auth');
Route::get('/consultar-usuario-ldap', [App\Http\Controllers\Controllers_Generic\LDAPController::class, 'consultarUsuarioLDAP'])->name('consultar-usuario-ldap');
Route::get('/consultar-datos-usuario-ldap', [App\Http\Controllers\Controllers_Generic\LDAPController::class, 'consultarDatosUsuarioLDAP'])->name('consultar-datos-usuario-ldap');

//FIXME: Eliminar esta ruta
Route::get('/consultar-datos-usuario-ldap-cedula/{cedula}', [App\Http\Controllers\Controllers_Generic\LDAPController::class, 'consultarDatosUsuarioLDAPXCedula'])->name('consultar-datos-usuario-ldap-cedula');

Route::get('/consultar', [App\Http\Controllers\Visitantes\VisitanteController::class, 'consultarVisitante'])->name('consultar-visitante');

Route::get('/reportes', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'index'])->name('reportes');

Route::get('/consultar-registro', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'getViewRegistersByFilters'])->name('consultar-registro');
Route::get('/export-excel', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'exportToExcelOrOpenOffice'])->name('export-excel');
Route::get('/export-pdf', [\App\Http\Controllers\Reportes\ReporteRegistroController::class, 'exportToPDF'])->name('export-pdf');

Route::resource('/usuarios', App\Http\Controllers\Administracion\UserController::class)->except('create');
Route::resource('/estado', App\Http\Controllers\Administracion\EstadoController::class)->except('create');
Route::resource('/gerencia', App\Http\Controllers\Administracion\GerenciaController::class)->except('create');
Route::resource('/operadoras', App\Http\Controllers\Administracion\OperadorasController::class)->except('create');
Route::resource('/personal', App\Http\Controllers\Administracion\PersonalController::class)->except('create');
Route::resource('/estatus', App\Http\Controllers\Administracion\EstatusController::class)->except('create');
Route::resource('/usuarios', App\Http\Controllers\Administracion\UserController::class)->except('create');
Route::resource('/cargo', App\Http\Controllers\Administracion\CargoController::class)->except('create');
Route::resource('/informacion', App\Http\Controllers\Administracion\InformacionController::class)->except('create');
Route::resource('/roles', App\Http\Controllers\Administracion\RolesController::class)->except('create');
Route::resource('/insumo', App\Http\Controllers\Administracion\InsumoController::class)->except('create');
Route::resource('/prioridad', App\Http\Controllers\Administracion\PrioridadController::class)->except('create');
Route::resource('/regiones', App\Http\Controllers\Administracion\RegionesController::class)->except('create');
Route::resource('/tendencia', App\Http\Controllers\Administracion\TendenciaController::class)->except('create');
Route::resource('/tipo_evento', App\Http\Controllers\Administracion\Tipo_eventoController::class)->except('create');
Route::resource('/tipo_informacion', App\Http\Controllers\Administracion\Tipo_informacionController::class)->except('create');


Route::resource('/registro', App\Http\Controllers\Registro\RegistroController::class)->except(['create']);
Route::resource('/visitantes', App\Http\Controllers\Visitantes\VisitanteController::class)->except(['destroy','create']);
Route::get('/getPerson', 'App\Http\Controllers\Registro\RegistroController@getPerson')->name('get.person');
Route::resource('/monitoreo', App\Http\Controllers\Monitoreo\MonitoreoController::class)->except(['create']);

Route::resource('/tendencia_ven', App\Http\Controllers\Tendencia_ven\Tendencia_venController::class)->except(['create']);

Route::get('/reportess', [\App\Http\Controllers\Reportess\ReportessController::class, 'index'])->name('reportess');
Route::get('/create', [\App\Http\Controllers\Reportess\ReportessController::class, 'create'])->name('create');

Route::get('/consultar-registro', [\App\Http\Controllers\Reportess\ReportessController::class, 'getViewRegistersByFilters'])->name('consultar-registro');
Route::get('/export-excel', [\App\Http\Controllers\Reportess\ReportessController::class, 'exportToExcelOrOpenOffice'])->name('export-excel');
Route::get('/export-pdf', [\App\Http\Controllers\Reportess\ReportessController::class, 'exportToPDF'])->name('export-pdf');

Route::get('/estados-por-region',[\App\Http\Controllers\Administracion\EstadoController::class, 'getEstadoByRegion'])->name('getEstadoByRegion');


Route::get('/informacion-por-tipo_informacion',[\App\Http\Controllers\Administracion\InformacionController::class, 'getInformacionesByTipos'])->name('getInformacionesByTipos');

Route::get('/reportestendencia', [\App\Http\Controllers\ReportesTendencia\ReportesTendenciaController::class, 'create'])->name('create');



