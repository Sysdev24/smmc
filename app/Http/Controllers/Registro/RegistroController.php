<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Operadoras;
use App\Models\Administracion\Plan;
use App\Models\Administracion\Estatus;
use App\Models\Administracion\Equipo;
use App\Models\Registro\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class RegistroController extends Controller
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
            return response()->json(view('registro.listado')->render());
        }
        $personal = Personal::pluck('ci','nombre','apellido', 'id_personal');
        $operadoras =Operadoras::pluck('descripcion', 'id_operadora');
        $plan = Plan::pluck('descripcion','id_plan');
        //dd($operadoras, $personal, $plan);
        return view('registro.index', compact('personal', 'operadoras', 'plan', 'equipo'));
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

            'ci' => 'required|numeric',
            /* 'nro_tlf' => 'required|numeric|max:12|unique:registro',
            'cuenta_uso' => 'required|numeric', */

        ];

        $messages = [

            'ci.required' => 'La cédula es obligatoria.',
            'ci.numeric' => 'La cédula debe ser un valor numérico.',
            /* 'nro_tlf.required' => 'El numero de telefono es obligatorio',
            'nro_tlf.numeric' => 'El numero de telefono debe ser un valor numérico',
            'nro_tlf.unique' => 'El nro de telefono ya está registrado.',
            'nro_tlf.max' => 'El numero de tlf superó el máximo de caracteres permitidos.',
            'cuenta_uso.required' => 'La cuenta uso es obligatorio',
            'cuenta_numeric' => 'La cuenta uso debe ser un valor numérico', */




        ];

       $validator = Validator::make($request->all(), $rules, $messages)->validate();



       try {

            $registro = new Registro();
            $registro->id_personal = $request->get('id_personal');
            $registro->nro_tlf = ($request->get('nro_tlf'));
            $registro->cuenta_uso = ($request->get('cuenta_uso'));
            $registro->observacion = $request->get('observacion');
            $registro->id_plan = $request->get('id_plan');
	        $registro->id_operadora = $request->get('operadoras');
			$registro->id_sede_equipo = $request->get('equipo');
            $registro->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en registro.store: " . $th. today());
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
        $registro = Registro::find($id);
        return response()->json(view('registro.show', compact('registro'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $registro = Registro::find($id);
        $plan = Plan::pluck('descripcion','id_plan');
        $estatus = Estatus::pluck('descripcion', 'id_estatus');
        $operadoras = Operadoras::pluck('descripcion', 'id_operadora');
        $personal = Personal::where('id_personal',$registro->id_personal)->get();//pluck('ci','nombre','apellido', 'id_personal');


        return response()->json(view('registro.edit', compact('plan', 'estatus','operadoras','personal','registro','equipo' ))->render());
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
            'cuenta_uso' => 'required|numeric',

        ];

        $messages = [

            'ci.required' => 'La cédula es obligatoria.',
            'cuenta_numeric' => 'La cuenta uso debe ser un valor numérico',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $registro = Registro::find($id);

            $registro->id_personal = $request->get('id_personal');
            $registro->nro_tlf = Str::upper($request->get('nro_tlf'));
            $registro->cuenta_uso = Str::upper($request->get('cuenta_uso'));
            $registro->observacion = $request->get('observacion');
            $registro->id_operadora = $request->get('operadoras');
            $registro->id_plan = $request->get('plan');
			$registro->id_sede_equipo = $request->get('equipo');
            $registro->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en registro.edit: " . $th . today());
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
            $registro = Registro::find($id);

            if ($registro->id_estatus == 1) {
                $registro->id_estatus = 2;
            } else {
                $registro->id_estatus = 1;
            }

            $registro->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en registro.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function getPerson(Request $request){
        //dd($request->all());
        $personal = Personal::where('ci', $request->ci)->first();

        return response()->json($personal);
    }
}
