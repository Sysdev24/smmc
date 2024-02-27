<?php

namespace App\Http\Controllers\Reportes;

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
//use App\Models\Administracion\Nomenclatura;
use App\Models\Registro\Registro;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ReporteRegistroController extends Controller
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

        $personal = Personal::pluck('ci','nombre','apellido', 'id_personal');
        $gerencia = Gerencia::pluck('descripcion','id_gerencia');
        $cargo = Cargo::pluck('descripcion','id_cargo');
        $estatus = Estatus::pluck('descripcion','id_estatus');
       // $nomenclatura = Nomenclatura::pluck('descripcion','id_nomenclatura');

        $fechaRegistro = Carbon::now();
		return view('reportes.index', compact('gerencia','personal','cargo','estatus','fechaRegistro'));
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

        $registro = DB::table('registro');


        foreach ($columnas as $key => $columna) {

            switch ($columna->columna) {
                case 'ci':
                    array_push($select, 'personal.ci');
                    break;
                case 'nombre':
                    array_push($select, 'personal.nombre');
                    break;
                case 'apellido':
                    array_push($select, 'personal.apellido');
                    break;
                case 'cargo':
                        array_push($select, 'cargo.descripcion as cargo');
                    break;
                case 'gerencia':
                    array_push($select, 'gerencia.descripcion as gerencia');
                    break;
                case 'estatus':
                    array_push($select, 'estatus.descripcion as estatus');
                    break;
                case 'nomenclatura':
                    array_push($select, 'nomenclatura.descripcion as nomenclatura');
                    break;
                case 'observacion':
                    array_push($select, 'registro.observacion');
                break;
                case 'asunto':
                    array_push($select, 'registro.asunto');
                break;
                case 'correlativo':
                    array_push($select, 'registro.correlativo');
                break;
                case 'anno':
                    array_push($select, 'registro.anno');
                break;
                case 'fecha':
                    array_push($select, 'registro.fecha');
                break;

            }
        }
        $registro = $registro->select($select);
        $registro = $registro->leftjoin('personal', 'personal.id_personal','registro.id_remitente' );
        $registro = $registro->leftjoin('estatus', 'estatus.id_estatus', 'registro.id_estatus');
        $registro = $registro->leftjoin('gerencia', 'gerencia.id_gerencia', 'personal.id_gerencia');
        $registro = $registro->leftjoin('cargo', 'cargo.id_cargo', 'personal.id_cargo');
        $registro = $registro->leftjoin('nomenclatura', 'nomenclatura.id_nomenclatura', 'registro.id_nomenclatura');

		 if (!empty($filtros->estatus)) {
             $registro = $registro->WhereIn('registro.id_estatus', $filtros->estatus);
        }

		 if (!empty($filtros->cargo)) {
            $registro = $registro->WhereIn('cargo.id_cargo', $filtros->cargo);
        }

		 if (!empty($filtros->gerencia)) {
            $registro = $registro->WhereIn('gerencia.id_gerencia', $filtros->gerencia);
        }

         if (!empty($filtros->nomenclatura)) {
            $registro = $registro->WhereIn('nomenclatura.id_nomenclatura', $filtros->nomenclatura);
       }

       $registro=$registro->whereDate("registro.created_at",$filtros->fechaRegistro);

      // $registro = $registro->whereBetween('registro.fecha_hora_entrada', [$entradaDesde, $entradaHasta]);


        // if ($filtros->conSalida && $filtros->sinSalida) {
        //     $registro = $registro->where(function ($q) {
        //         $q->whereNotNull('registro.created_at')->orWhereNull('registro.created_at');
        //     });
        // }

        // if ($filtros->conSalida && !$filtros->sinSalida) {
        //     $registro = $registro->whereNotNull('registro.created_at');
        // }

        // if (!$filtros->conSalida && $filtros->sinSalida) {
        //     $registro = $registro->WhereNull('registro.created_at');
        // }

        // $entradaDesde = DateTime::createFromFormat('d/m/Y',  $filtros->fechaEntradaDesde)->format('Y/m/d');
        // $entradaHasta = DateTime::createFromFormat('d/m/Y',  $filtros->fechaEntradaHasta)->format('Y/m/d');

        // $registro = $registro->whereBetween('registro.created_at', [$entradaDesde, $entradaHasta]);

        if (!empty($orderBy)) {
            foreach ($orderBy as $valor) {
                switch ($valor->columna) {
                    case 'ci':
                        $registro = $registro->orderBy('personal.ci', $valor->orden);
                        break;
                    case 'nombre':
                        $registro = $registro->orderBy('personal.nombre', $valor->orden);
                        break;
                    case 'apellido':
                        $registro = $registro->orderBy('personal.apellido', $valor->orden);
                        break;
                    case 'cargo':
                        $registro = $registro->orderBy('cargo.descripcion', $valor->orden);
                        break;
                    case 'gerencia':
                        $registro = $registro->orderBy('gerencia.descripcion', $valor->orden);
                        break;
                    case 'estatus':
                        $registro = $registro->orderBy('estatus.descripcion', $valor->orden);
                        break;
                    case 'observacion':
                        $registro = $registro->orderBy('registro.observacion', $valor->orden);
                        break;
                    case 'asunto':
                        $registro = $registro->orderBy('registro.asunto', $valor->orden);
                        break;
                    case 'observacion':
                        $registro = $registro->orderBy('registro.correlativo', $valor->orden);
                        break;
                    case 'asunto':
                        $registro = $registro->orderBy('registro.anno', $valor->orden);
                        break;
                    case 'fecha':
                        $registro = $registro->orderBy('registro.fecha', $valor->orden);
                        break;
                }
            }
        }
        $registro = $registro->get();
        return $registro;
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
        //return "oK";//$registros;
        return view('reportes.result', compact('titulo', 'columnas', 'registros'));
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

        foreach ($columnas as $columna) {
            switch ($columna->columna) {
                case 'registro':
                    $sheet->setCellValueByColumnAndRow($cont,     2, $columna->alias . ' (CÉDULA)');
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
            'reportes.pdf',
            [
                'data' => $registro,
                'logo' => $logo,
                'columnas' => $columnas,
                'titulo' => $titulo
            ]
        )->setPaper('letter', 'landscape')
            ->setOption(['dpi' => $dpi]);
        return $pdf->download($titulo . '.pdf');
        return view('reportes.pdf', compact('Registro', 'logo','columnas','titulo'));
    }

    public function registro_pdf(){

        //$registro = Registro::findOrFail();

        $pdf = Pdf::loadView('reportes.acta_pdf');
        // compact('registro'));
        return $pdf ->stream('Registro de correspondencia.pdf');

    }
}
