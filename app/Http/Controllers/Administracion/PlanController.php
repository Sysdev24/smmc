<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PlanController extends Controller
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
			return response()->json(view('administracion.plan')->render());
        }

        return view('administracion.plan.index');
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
            'descripcion' => 'required|unique:plan|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
			'monto_credito' => 'required|numeric',
        ];

        $messages = [
            'descripcion.required' => 'El nombre del plan es obligatorio.',
            'descripcion.unique' => 'El plan ya está registrada.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
			'monto_credito.required' => 'El monto credito obligatorio.',
			'monto_credito.numeric' => 'el monto credito debe ser un valor numérico.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $plan = new Plan();
            $plan->descripcion = Str::upper($request->get('descripcion'));
			$plan->monto_credito = Str::upper($request->get('monto_credito'));
			
			 $plan->save();
			 
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en plan.store: " . $th);
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administracion\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::find($id);
        return response()->json(view('administracion.plan.show', compact('plan'))->render());
    }
	
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administracion\plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $plan = Plan::find($id);
        return response()->json(view('administracion.plan.edit', compact('plan'))->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administracion\plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'descripcion' => 'required|unique:plan,descripcion,' . $id . ',id_plan|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
			'monto_credito' => 'required|numeric',
        ];

        $messages = [
            'descripcion.required' => 'El nombre del plan es obligatorio.',
            'descripcion.unique' => 'El plan ya está registrado.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
			'monto_credito.required' => 'El monto credito obligatorio.',
			'monto_credito.numeric' => 'el monto credito debe ser un valor numérico.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $plan = Plan::find($id);
            $plan->descripcion = Str::upper($request->get('descripcion'));
			$plan->monto_credito = Str::upper($request->get('monto_credito'));
			
            $plan->save();	

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en plan.store: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administracion\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $plan = Plan::find($id);

            if ($plan->id_estatus = 1) {
                $plan->id_estatus = 2;
            } else {
                $plan->id_estatus = 1;
            }

            $plan->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en plan.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
