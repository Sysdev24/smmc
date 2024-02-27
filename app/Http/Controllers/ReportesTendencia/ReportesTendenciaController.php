<?php

namespace App\Http\Controllers\ReportesTendencia;

use DateTime;
use PgSql\Lob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Gerencia;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Administracion\Cargo;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Estatus;
use App\Models\Administracion\Tendencia;
use App\Models\Monitoreo\Monitoreo;
use App\Models\Registro\Registro;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ReportesTendenciaController extends Controller
{


    /**
     * |La función __construct() es una función especial que se llama automáticamente cuando se crea un|
     * |objeto.                                                                                        |
     */
    public function create (Request $request) {

        $solicitudes =  $data = Monitoreo::
        select(
                DB::raw('UPPER(estatus.estatus) as estatus_usuario'),
                    DB::raw('COUNT(usuarios.id) as total'),
                )
                ->join('estatus','estatus.id','usuarios.estatus_usuario')
                ->join('tramite','tramite.usuario_id','usuarios.id')
                ->groupBy(
                      'estatus.id'
                )
                ->orderBy('estatus.id', 'ASC')
                ->get();

        $data = [];

        foreach($solicitudes as $solicitud){
            $data['label'][] = $solicitud->tendencia.id_tendencia;
            $data['data'][] =  $solicitud->total;
        }
        $data['data'] = json_encode($data);

        $dataSolicitudes = Tendencia::
        select(
                DB::raw('UPPER(tendencia.id_tendencia) as tendencia.id_tendencia'),
                    DB::raw('COUNT(monitoreo.id) as total'),
                )
                ->join('tendencia','tendencia.id_tendencia','monitoreo.tendencia')
                ->join('tendencia','tendencia.id_tendencia','id_tendencia')
                ->groupBy(
                      'id_tendencia'
                )
                ->orderBy('id_tendencia', 'ASC')
                ->get()->sum('total');





        return view('reportes_graficos.solicitudes', $data)
                ->with(['solicitudes' => $solicitudes])
                ->with(['dataSolicitudes' => $dataSolicitudes]);

    }
}
