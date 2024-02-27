<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Proceso_relacionado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Proceso_relacionadoController extends Controller
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
            return response()->json(view('administracion.proceso_relacionado.listado')->render());
        }

        return view('administracion.proceso_relacionado.index');
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
            'descripcion' => 'required|unique:proceso_relacionado|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El Proceso relacionado es obligatorio.',
            'descripcion.max' => 'El Proceso relacionado el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El Proceso relacionado ya esta registrado.',
			'descripcion.alpha' => 'El Proceso relacionado debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $proceso_relacionado = new Proceso_relacionado();
            $proceso_relacionado->descripcion = Str::upper($request->get('descripcion'));
            $proceso_relacionado->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en proceso_relacionado.store: " . $th);
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proceso_relacionado = Proceso_relacionado::find($id);
        return response()->json(view('administracion.proceso_relacionado.show', compact('proceso_relacionado'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proceso_relacionado = Proceso_relacionado::find($id);
        return response()->json(view('administracion.proceso_relacionado.edit', compact('proceso_relacionado'))->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'descripcion' => 'required|unique:proceso_relacionado,descripcion,' . $id . ',id_proceso_relacionado|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'El proceso relacionado es obligatorio.',
            'descripcion.max' => 'El tipo de proceso relacionado el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El proceso relacionado ya esta registrado.',
			'descripcion.alpha' => 'El proceso relacionado debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $proceso_relacionado = Proceso_relacionado::find($id);
            $proceso_relacionado->descripcion = Str::upper($request->get('descripcion'));
            $proceso_relacionado->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en proceso_relacionado.edit: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $proceso_relacionado =  Proceso_relacionado::find($id);

            if ($proceso_relacionado->id_estatus == 1) {
                $proceso_relacionado->id_estatus = 2;
            } else {
                $proceso_relacionado->id_estatus = 1;
            }

            $proceso_relacionado->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en proceso_relacionado.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
