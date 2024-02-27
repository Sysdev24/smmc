<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Operadora;
use App\Models\Administracion\Plan;
use App\Models\Administracion\Estatus;
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
            return response()->json(view('registro.registro.listado')->render());
        }
        $personal = Personal::pluck('cedula','nombre','apellido', 'id_personal');
        $operadora =Operadora::pluck('descripcion', 'id_operadora');
        $plan = Plan::pluck('descripcion', 'monto_credito','id_plan');
        return view('registro.registro.index', compact('personal', 'operadora', 'plan'));
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
            'id_personal' => 'required',
            'id_operadora' => 'required',
            'id_plan' => 'required',
            'nro_telf' => 'required|numeric',
            'cuenta_uso' => 'required|numeric',
            'observacion' => 'required|max:100',
            'id_estatus' => 'required',
        ];

        $messages = [
            'required' => 'La cédula es obligatoria.',
            'id_personal.numeric' => 'La cédula debe ser un valor numérico.',
            'nro_telf.numeric' => 'El numero de telefono debe ser un valor numérico.',
            'nro_telf.required' => 'El numero de telefono es obligatorio',
        ];

       // $validator = Validator::make($request->all(), $rules, $messages);

       /* if( $validator->fails() ) 
        {
            return [
                'success' => 0, 
                'message' => $validator->errors()->first()
            ];
        }*/

        try {

            $registro = new Registro();

            $registro->id_personal = $request->get('personal');
            $registro->nro_telf = Str::upper($request->get('nro_telf'));
            $registro->cuenta_uso = Str::upper($request->get('cuenta_uso'));
            $registro->observacion = $request->get('observacion');
            $registro->id_plan = $request->get('plan');
	        $registro->id_operadora = $request->get('operadora');
            $registro->id_estatus = $request->get('estatus');

            $registro->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en registro.store: " . $th);
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
        return response()->json(view('registro.registro.show', compact('registro'))->render());
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
        $plan = Plan::pluck('descripcion', 'monto_credito','id_plan');
        $estatus = Estatus::pluck('descripcion', 'id_estatus');
        $operadora = Operadora::pluck('descripcion', 'id_operadora');
        $personal = Personal::pluck('ci','nombre','apellido', 'id_personal'); 
        return response()->json(view('registro.registro.edit', compact('personal', 'plan', 'estatus','operadora'))->render());
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
            'id_personal' => 'required',
            'id_operadora' => 'required',
            'id_plan' => 'required',
            'nro_telf' => 'required|numeric',
            'cuenta_uso' => 'required|numeric',
            'observacion' => 'required|max:100',
            'id_estatus' => 'required',

        ];

        $messages = [
            'required' => 'La cédula es obligatoria.',
            'id_personal.numeric' => 'La cédula debe ser un valor numérico.',
            'nro_telf.numeric' => 'El numero de telefono debe ser un valor numérico.',
            'nro_telf.required' => 'El numero de telefono es obligatorio',
        ];
     
        try {
           
            $registro = Registro::where('id_registro', $id)->first();

            $registro->id_personal = $request->get('personal');
            $registro->nro_telf = Str::upper($request->get('nro_telf'));
            $registro->cuenta_uso = Str::upper($request->get('cuenta_uso'));
            $registro->observacion = $request->get('observacion');
            $registro->id_plan = $request->get('plan');
	        $registro->id_operadora = $request->get('operadora');
            $registro->id_estatus = $request->get('estatus');

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
}
