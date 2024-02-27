<?php

namespace App\Http\Controllers\Reportess;

use DateTime;
use PgSql\Lob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Estado;
use App\Models\Administracion\Gerencia;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Administracion\Tendencia;
use App\Models\Administracion\Insumo;
use App\Models\Administracion\Regiones;
use App\Models\Administracion\Informacion;
use App\Models\Administracion\Tipo_evento;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Estatus;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ReportessController extends Controller
{


    /**
     * |La función __construct() es una función especial que se llama automáticamente cuando se crea un|
     * |objeto.                                                                                        |
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $personal = Personal::pluck('nombre','apellido', 'id_personal');
        $tipo_evento = Tipo_evento::pluck('descripcion','id_tipo_evento');
        $informacion = Informacion::pluck('descripcion','id_informacion');
        $estado = Estado::orderBy("descripcion")->get()->pluck("descripcion", "id_estado");
        $tendencia = Tendencia::pluck('descripcion','id_tendencia');
        $insumo = Insumo::pluck('descripcion','id_insumo');
        $estatus = Estatus::pluck('descripcion','id_estatus');
        return view('reportess.index', compact('personal','tipo_evento','informacion', 'estado','tendencia','insumo',));



    }




    /**
     * |Creación de una matriz de columnas para seleccionar de la base de datos.|
     * |Consulta los visitantes según los parámetros enviados el la solicitud   |
     * @return \Illuminate\Support\Collection
     * @param mixed $columnas
     */
    public function getRegistersByFilters($columnas, $filtros, $orderBy = [])
    {

        $select = [];
        //$orderBy = [];

        $registro = DB::table('monitoreo');


        foreach ($columnas as $key => $columna) {

            switch ($columna->columna) {
                case 'id_personal':
                    array_push($select, 'personal.id_personal');
                    break;
                case 'ci':
                    array_push($select, 'personal.ci');
                    break;
                case 'nombre':
                    array_push($select, 'personal.nombre');
                    break;
                case 'apellido':
                    array_push($select, 'personal.apellido');
                    break;
                    case 'tipo_evento':
                        array_push($select, 'tipo_evento.descripcion as tipo_evento');
                    break;
                    case 'informacion':
                        array_push($select, 'informacion.descripcion as informacion');
                    break;
                    case 'tipo_informacion':
                        array_push($select, 'tipo_informacion.descripcion as tipo_informacion');
                    break;

                case 'estado':
                    array_push($select, 'estado.descripcion as estado');
                    break;
                    case 'tendencia':
                        array_push($select, 'tendencia.descripcion as tendencia');
                    break;
                    case 'insumo':
                        array_push($select, 'insumo.descripcion as insumo');
                        break;
                        case 'estatus':
                            array_push($select, 'estatus.descripcion as estatus');
                            break;

                        case 'fecha':
                            array_push($select, 'monitoreo.fecha');
                        break;
                        case 'correlativo':
                            array_push($select, 'monitoreo.link');
                        break;
                        case 'descripcion':
                            array_push($select, 'monitoreo.descripcion');
                            break;
            }
        }
        $registro = $registro->select($select);
        $registro = $registro->leftjoin('personal', 'personal.id_personal','monitoreo.id_personal' );
        $registro = $registro->leftjoin('tipo_evento', 'tipo_evento.id_tipo_evento','monitoreo.tipo_evento' );
        $registro = $registro->leftjoin('informacion', 'informacion.id_informacion','monitoreo.informacion' );
        $registro = $registro->leftjoin('tipo_informacion', 'tipo_informacion.id_tipo_informacion','monitoreo.tipo_informacion' );
        $registro = $registro->leftjoin('estados', 'estados.id_estado', 'monitoreo.estado');
        $registro = $registro->leftjoin('tendencia', 'tendencia.id_tendencia', 'monitoreo.tendencia');
        $registro = $registro->leftjoin('insumo', 'insumo.id_insumo', 'monitoreo.insumo');
        $registro = $registro->leftjoin('estatus', 'estatus.id_estatus', 'monitoreo.id_estatus');


		 if (!empty($filtros->estatus)) {
             $registro = $registro->WhereIn('monitoreo.id_estatus', $filtros->estatus);
        }

		 if (!empty($filtros->tendencia)) {
            $registro = $registro->WhereIn('tendencia.id_tendencia', $filtros->tendencia);
        }

		 if (!empty($filtros->estados)) {
            $registro = $registro->WhereIn('estados.id_estado', $filtros->estados);
        }
        if (!empty($filtros->insumo)) {
            $registro = $registro->WhereIn('insumo.id_insumo', $filtros->insumo);
       }
        // if ($filtros->conSalida && $filtros->sinSalida) {
        //     $monitoreo = $monitoreo->where(function ($q) {
        //         $q->whereNotNull('monitoreo.created_at')->orWhereNull('monitoreo.created_at');
        //     });
        // }

        // if ($filtros->conSalida && !$filtros->sinSalida) {
        //     $monitoreo = $monitoreo->whereNotNull('monitoreo.created_at');
        // }

        // if (!$filtros->conSalida && $filtros->sinSalida) {
        //     $monitoreo = $monitoreo->WhereNull('monitoreo.created_at');
        // }

         //$entradaDesde = DateTime::createFromFormat('d/m/Y',  $filtros->fechaEntradaDesde)->format('Y/m/d');
         //$entradaHasta = DateTime::createFromFormat('d/m/Y',  $filtros->fechaEntradaHasta)->format('Y/m/d');

         //$monitoreo = $monitoreo->whereBetween('monitoreo.created_at', [$entradaDesde, $entradaHasta]);

        if (!empty($orderBy)) {
            foreach ($orderBy as $valor) {
                switch ($valor->columna) {
                    case 'id':
                        $registro = $registro->orderBy('personal.id', $valor->orden);
                        break;
                    case 'nombre':
                        $registro = $registro->orderBy('personal.nombre', $valor->orden);
                        break;
                    case 'apellido':
                        $registro = $registro->orderBy('personal.apellido', $valor->orden);
                        break;
                    case 'tipo_evento':
                        $registro = $registro->orderBy('tipo_evento.descripcion', $valor->orden);
                        break;
                    case 'informacion':
                        $registro = $registro->orderBy('informacion.descripcion', $valor->orden);
                        break;
                    case 'fecha':
                        $registro = $registro->orderBy('fecha.descripcion', $valor->orden);
                        break;
                    case 'link':
                        $registro = $registro->orderBy('link.descripcion', $valor->orden);
                        break;
                    case 'descripcion':
                        $registro = $registro->orderBy('descripcion.descripcion', $valor->orden);
                        break;

                }
            }
        }
        $registro = $registro->get();
        return $registro;
    }
/********************************* */
    public function create()
    {
        $regiones = Regiones::pluck('descripcion','id_regiones');
        $estado = Estado::pluck("descripcion","id_estado");
        $informacion = Informacion::pluck('descripcion','id_informacion');
        $tipo_evento = Tipo_evento::pluck('descripcion','id_tipo_evento');
		return view('reportess.create', compact('regiones','estado','informacion','tipo_evento'));
    }


    /**
     * |Devuelve una respuesta  con la vista de reportes-visitates.result|
     *
     * @param Request request El objeto de la solicitud.
     */
    public function getViewRegistersByFilters(Request $request)
    {


        $param = json_decode($request->q);
        $titulo = $param->titulo;
        $filtros = $param->filtros;
        $columnas = $param->columnas;

        $registros = self::getRegistersByFilters($columnas, $filtros);
        //return "oK";//$registro;
        return view('reportess.result', compact('titulo', 'columnas', 'registros'));
    }





    /**
     * |Toma un objeto de solicitud, obtiene los datos de la base de datos y luego crea una hoja de |
     * |cálculo con los datos.                                                                      |
     *
     * @param Request request El objeto de la solicitud.
     * @return un objeto de hoja de cálculo.
     */
    public function buildReport($columnas, $filtros, $titulo, $orderBy = [])
    {


        $registro = self::getRegistersByFilters($columnas, $filtros, $orderBy);
        $fila_ini_datos = 3;
        $cont = 1;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $colSheet = range('A', 'Z');
        $mergeColTitle = $colSheet[count($columnas)];

        $sheet->mergeCells('A1:' . $mergeColTitle . '1');
        $sheet->setCellValue('A1', mb_strtoupper($titulo));

        //FOREACH PARA GENERAR EXCEL
        foreach ($columnas as $columna) {
            switch ($columna->columna) {
                case 'registro':
                    $sheet->setCellValueByColumnAndRow($cont,     2, $columna->alias . ' (ID)');
                    $sheet->setCellValueByColumnAndRow($cont + 1, 2, $columna->alias . ' (NOMBRE Y APELLIDO)');
                    $cont++;
                    break;
                default:
                    $sheet->setCellValueByColumnAndRow($cont, 2, $columna->alias);
                    break;
            }
            $cont++;
        }

        foreach ($registro as $data) {

            $cont = 1;
            foreach ($data as $valor) {

                if ($valor === true) {

                    $sheet->setCellValueByColumnAndRow($cont, $fila_ini_datos, "SÍ");
                } elseif ($valor === false) {

                    $sheet->setCellValueByColumnAndRow($cont, $fila_ini_datos, "NO");
                } else {
                    //* Imprime si es un campo fecha imprime formateado
                    if (DateTime::createFromFormat('Y-m-d H:i:s', $valor) !== false) {

                        $sheet->setCellValueByColumnAndRow($cont, $fila_ini_datos, date('d/m/Y h:i a', strtotime($valor)));
                    } else {

                        $sheet->setCellValueByColumnAndRow($cont, $fila_ini_datos, $valor);
                    }

                }

                $cont++;
            }
            $fila_ini_datos++;
        }

        return $spreadsheet;
    }



    /**
     * |Toma una solicitud, crea un informe y luego lo exporta al formato deseado|
     *
     * @param Request request El objeto de la solicitud.
     */
    public function exportToExcelOrOpenOffice(Request $request)
    {

        $param = json_decode($request->q);
        $titulo = $param->titulo;
        $filtros = $param->filtros;
        $columnas = $param->columnas;
        $formato = $param->formato;
        $orderBy = $param->orderBy;


        $spreadsheet = self::buildReport($columnas, $filtros, $titulo, $orderBy);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $titulo . '.' . $formato . '"');
        header('Cache-Control: max-age=0');

        switch ($formato) {
            case 'xls':
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
                $writer->save('php://output');
                break;
            case 'ods':
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Ods');
                $writer->save('php://output');
                break;
        }
    }

    /**
     * |Toma una solicitud, obtiene los datos de la base de datos y luego devuelve un archivo PDF.|
     * @param Request request El objeto de la solicitud.
     * @return El archivo PDF está siendo devuelto.
     */
    public function exportToPDF(Request $request)
    {
        //-define("DOMPDF_ENABLE_REMOTE", true);

        $path = 'img/cintillo-superior.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $param = json_decode($request->q);
        $titulo = $param->titulo;
        $filtros = $param->filtros;
        $columnas = $param->columnas;
        $orderBy = $param->orderBy;
        $dpi = 100;

        $registro = self::getRegistersByFilters($columnas, $filtros,$orderBy);

        if (count($columnas) >= 15 && count($columnas) <= 10) {
            $dpi = 150;
        } elseif (count($columnas) > 16) {
            $dpi = 200;
        }

        view()->share('registro', $registro);

        $pdf = Pdf::loadView(
            'reportess.pdf',
            [
                'data' => $registro,
                'logo' => $logo,
                'columnas' => $columnas,
                'titulo' => $titulo
            ]
        )->setPaper('letter', 'landscape')
            ->setOption(['dpi' => $dpi]);
        return $pdf->download($titulo . '.pdf');
        return view('reportess.pdf', compact('registro', 'logo','columnas','titulo'));
    }

}
