<?php

namespace App\Http\Controllers\Tendencia_ven;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Informacion;
use App\Models\Administracion\Tendencia;
use App\Models\Administracion\Estatus;
use App\Models\Tendencia_ven\Tendencia_ven;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class Tendencia_venController extends Controller
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
            return response()->json(view('tendencia_ven.listado')->render());
        }
        $informacion = Informacion::pluck('descripcion','id_informacion');
        $tendencia =Tendencia::pluck('descripcion', 'id_tendencia');
        $estatus = Estatus::pluck('descripcion','id_estatus');

        //dd($operadoras, $personal, $plan);
        return view('tendencia_ven.index', compact('informacion', 'tendencia', 'estatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules = [

            'posicion' => 'required|numeric',
            'informacion' => 'required',
            'tipo_informacion' => 'required',
            'tendencia_actual' => 'required',
            'descripcion' => 'required|max:100',
            'link' => 'required',


        ];

        $messages = [

            'posicion.required' => 'La fecha es obligatoria.',
            'posicion.numeric' => 'La fecha debe ser un valor numérico.',



        ];

       $validator = Validator::make($request->all(), $rules, $messages)->validate();

       try {

         $tendencia_ven = new Tendencia_ven ();
         $tendencia_ven->fecha               = $request->get('fecha');
         $tendencia_ven->descripcion_tend    = $request->get('descripcion_tend');
         $tendencia_ven->observacion         = $request->get('observacion');
         $tendencia_ven->id_informacion      = $request->get('id_informacion ');
         $tendencia_ven->tendencia_actual    = $request->get('tendencia_actual');
         $tendencia_ven->id_tendencia        = $request->get('id_tendencia');
         $tendencia_ven->posicion            = $request->get('posicion');
         $tendencia_ven->link                = $request->get('link');

         //dd($tendencia_ven);
         $tendencia_ven->save();

         return response()->json(['mensaje' => 'success'], 200);
         //dd('Guardo todo bien...');
     } catch (\Throwable $th) {
         Log::error("Error en tendencia_ven.store: " . $th. today());
         //dd('Error pendejo');
         return response()->json(['mensaje' => 'Error interno'], 500);
     }
 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $tendencia_ven = Tendencia_ven::find($id);
        return response()->json(view('tendencia_ven.show', compact('tendencia_ven'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {

        $tendencia_ven = Tendencia_ven::find($id);
        $informacion = Informacion::pluck('descripcion','id_informacion');
        $tendencia = Tendencia::pluck('descripcion', 'id_tendencia');
        $estatus = Estatus::pluck('descripcion', 'id_estatus');



      return response()->json(view('tendencia_ven.edit', compact('tendencia_ven','informacion','tendencia','estatus' ))->render());
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

            'posicion' => 'required',


        ];

        $messages = [

            'posicion.required' => 'La posicion es obligatoria.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $tendencia_ven = new Tendencia_ven ();
            $tendencia_ven->fecha               = $request->get('fecha');
            $tendencia_ven->descripcion_tend    = $request->get('descripcion_tend');
            $tendencia_ven->observacion         = $request->get('observacion');
            $tendencia_ven->id_informacion      = $request->get('id_informacion ');
            $tendencia_ven->tendencia_actual    = $request->get('tendencia_actual');
            $tendencia_ven->id_tendencia        = $request->get('id_tendencia');
            $tendencia_ven->posicion            = $request->get('posicion');
            $tendencia_ven->link                = $request->get('link');

            //dd($tendencia_ven);
            $tendencia_ven->save();

            return response()->json(['mensaje' => 'success'], 200);
            //dd('Guardo todo bien...');
        } catch (\Throwable $th) {
            Log::error("Error en tendencia_ven.store: " . $th. today());
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
            $tendencia_ven = Tendencia_ven::find($id);

            if ($tendencia_ven->id_estatus == 1) {
                $tendencia_ven->id_estatus = 2;
            } else {
                $tendencia_ven->id_estatus = 1;
            }

            $tendencia_ven->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tendencia_ven.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }


}
