<?php

namespace App\Http\Controllers\Monitoreo;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Informacion;
use App\Models\Administracion\Tendencia;
use App\Models\Administracion\Insumo;
use App\Models\Administracion\Estatus;
use App\Models\Administracion\Regiones;
use App\Models\Administracion\Tipo_evento;
use App\Models\Administracion\Tipo_informacion;
use App\Models\Administracion\Estado;
use App\Models\Monitoreo\Monitoreo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class MonitoreoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
        //dd($request->ajax());

            return response()->json(view('monitoreo.listado')->render());

        }
        $personal = Personal::pluck('ci','nombre','apellido', 'id_personal');
        $tipo_informacion = Tipo_informacion::pluck('descripcion','id_tipo_informacion');
        $informacion =Informacion::pluck('descripcion','id_informacion');
        $tendencia =Tendencia::pluck('descripcion', 'id_tendencia');
        $insumo = Insumo::pluck('descripcion','id_insumo');
        $regiones = Regiones::pluck('descripcion','id_regiones');
        $estado = Estado::pluck('descripcion','id_estado');
        $tipo_evento =Tipo_evento::pluck('descripcion','id_tipo_evento');
        $estatus = Estatus::pluck('descripcion', 'id_estatus');



        //dd($tendencia, $personal, $estatus, 'hika');
        return view('monitoreo.index', compact('personal','tipo_informacion', 'informacion','tendencia','insumo','regiones','estado', 'tipo_evento','estatus' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**----AGRAGAR--*/
    public function store(Request $request)
    {


        $rules = [

            'ci' => 'required|numeric',
            'informacion' => 'required',
            'tipo_informacion' => 'required',
            'insumo' => 'required',
            'tendencia' => 'required',
            'tipo_evento' => 'required',
            'descripcion' => 'required|max:100',
            'link' => 'required',



        ];

        $messages = [

            'ci.required' => 'La cédula es obligatoria.',
         /* 'informacion.required' => 'El campo debe ser obligatorio',
            'tipo_informacion' => 'El numero de telefono debe ser un valor numérico',
            'insumo' => 'El nro de telefono ya está registrado.',
            'tendencia' => 'El numero de tlf superó el máximo de caracteres permitidos.',
            'tipo_evento' => 'La cuenta uso es obligatorio', */

        ];

       $validator = Validator::make($request->all(), $rules, $messages)->validate();

       try {

            $monitoreo = new Monitoreo();
            $monitoreo->id_personal         = $request->get('id_personal');
            $monitoreo->fecha               = $request->get('fecha');
            $monitoreo->tipo_informacion    = $request->get('tipo_informacion');
            $monitoreo->informacion         = $request->get('informacion');
            $monitoreo->descripcion         = $request->get('descripcion');
			$monitoreo->link                = $request->get('link');
            $monitoreo->insumo              = $request->get('insumo');
            $monitoreo->regiones            = $request->get('regiones');
            $monitoreo->estado              = $request->get('estado');
            $monitoreo->tendencia           = $request->get('tendencia');
            $monitoreo->tipo_evento         = $request->get('tipo_evento');
            //dd($monitoreo);
            $monitoreo->save();

            return response()->json(['mensaje' => 'success'], 200);
            //dd('Guardo todo bien...');
        } catch (\Throwable $th) {
            Log::error("Error en monitoreo.store: " . $th. today());
            //dd('Error pendejo');
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function show($id)
    {
        $monitoreo = monitoreo::find($id);
        return response()->json(view('monitoreo.show', compact('monitoreo'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
        /**----EDITAR--*/
    public function edit($id, Request $request)
    {
        $monitoreo = Monitoreo::find($id);
        $insumo = Insumo::pluck('descripcion', 'id_insumo');
        $tendencia =Tendencia::pluck('descripcion', 'id_tendencia');
        $informacion =Informacion::pluck('descripcion','id_informacion');
        $tipo_informacion =Tipo_informacion::pluck('descripcion','id_tipo_informacion');
        $regiones = Regiones::pluck('descripcion','id_regiones');
        $tipo_evento =Tipo_evento::pluck('descripcion','id_tipo_evento');
        $personal = Personal::where('id_personal',$monitoreo->id_personal)->get();//pluck('ci','nombre','apellido', 'id_personal');
        $estatus = Estatus::pluck('descripcion', 'id_estatus');
        $estado = Estado::pluck('descripcion', 'id_estado');


        return response()->json(view('monitoreo.edit', compact('monitoreo','insumo', 'tendencia', 'informacion','tipo_informacion','regiones','tipo_evento','personal','estatus','estado' ))->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {




        $rules = [

            'ci' => 'required',



        ];

        $messages = [

            'ci.required' => 'La cédula es obligatoria.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();


        try {

             $monitoreo = Monitoreo::find($id);
             $monitoreo->id_personal         = $request->get('id_personal');
             $monitoreo->fecha               = $request->get('fecha');
             $monitoreo->tipo_informacion    = $request->get('tipo_informacion');
             $monitoreo->informacion         = $request->get('informacion');
             $monitoreo->descripcion         = $request->get('descripcion');
             $monitoreo->link                = $request->get('link');
             $monitoreo->insumo              = $request->get('insumo');
             $monitoreo->regiones            = $request->get('regiones');
             $monitoreo->estado              = $request->get('estado');
             $monitoreo->tendencia           = $request->get('tendencia');
             $monitoreo->tipo_evento         = $request->get('tipo_evento');
             //dd($monitoreo);
             $monitoreo->save();

             return response()->json(['mensaje' => 'success'], 200);
             //dd('Guardo todo bien...');
         } catch (\Throwable $th) {
             Log::error("Error en monitoreo.edit: " . $th. today());
             //dd('Error pendejo');
             return response()->json(['mensaje' => 'Error interno'], 500);
         }
     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $monitoreo = Monitoreo::find($id);

            if ($monitoreo->id_estatus == 1) {
                $monitoreo->id_estatus = 2;
            } else {
                $monitoreo->id_estatus = 1;
            }

            $monitoreo->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en monitoreo.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function getPerson(Request $request){
        //dd($request->all());
        $personal = Personal::where('ci', $request->ci)->first();

        return response()->json($personal);
    }




}


