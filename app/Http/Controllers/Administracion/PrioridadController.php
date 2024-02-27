<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Prioridad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PrioridadController extends Controller
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
            return response()->json(view('administracion.prioridad.listado')->render());
        }

        return view('administracion.prioridad.index');
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
            'descripcion' => 'required|unique:prioridad|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El prioridad es obligatorio.',
            'descripcion.max' => 'El prioridad el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El prioridad ya esta registrado.',
			'descripcion.alpha' => 'El prioridad debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $prioridad = new Prioridad();
            $prioridad->descripcion = Str::upper($request->get('descripcion'));
            $prioridad->save();

             return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en prioridad.store: " . $th);
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
        $prioridad = prioridad::find($id);
        return response()->json(view('administracion.prioridad.show', compact('prioridad'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prioridad = Prioridad::find($id);
        return response()->json(view('administracion.prioridad.edit', compact('prioridad'))->render());
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
            'descripcion' => 'required|unique:prioridad,descripcion,' . $id . ',id_prioridad|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'El prioridad es obligatorio.',
            'descripcion.max' => 'El tipo de prioridad el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El prioridad ya esta registrado.',
			'descripcion.alpha' => 'El prioridad debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $prioridad = Prioridad::find($id);
            $prioridad->descripcion = Str::upper($request->get('descripcion'));
            $prioridad->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en prioridad.edit: " . $th . today());
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
            $prioridad = prioridad::find($id);

            if ($prioridad->id_estatus == 1) {
                $prioridad->id_estatus = 2;
            } else {
                $prioridad->id_estatus = 1;
            }

            $prioridad->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en prioridad.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
