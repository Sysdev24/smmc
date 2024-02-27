<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Informacion;
use App\Models\Administracion\Tipo_informacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Tipo_informacionController extends Controller
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
            return response()->json(view('administracion.tipo_informacion.listado')->render());
        }

        return view('administracion.tipo_informacion.index');
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
            'descripcion' => 'required|unique:tipo_informacion|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El tipo informacion es obligatorio.',
            'descripcion.max' => 'El tipo informacion el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El tipo informacion ya esta registrado.',
			'descripcion.alpha' => 'El tipo informacion debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $tipo_informacion = new Tipo_informacion();
            $tipo_informacion->descripcion = Str::upper($request->get('descripcion'));
            $tipo_informacion->save();

             return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tipo informacion.store: " . $th);
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
        $tipo_informacion = Tipo_informacion::find($id);
        return response()->json(view('administracion.tipo_informacion.show', compact('tipo_informacion'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_informacion = Tipo_informacion::find($id);
        return response()->json(view('administracion.tipo_informacion.edit', compact('tipo_informacion'))->render());
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
            'descripcion' => 'required|unique:tipo_informacion,descripcion,' . $id . ',id_tipo_informacion|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'El tipo informacion es obligatorio.',
            'descripcion.max' => 'El tipo de tipo informacion el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El tipo informacion ya esta registrado.',
			'descripcion.alpha' => 'El tipo informacion debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $tipo_informacion = Tipo_informacion::find($id);
            $tipo_informacion->descripcion = Str::upper($request->get('descripcion'));
            $tipo_informacion->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tipo_informacion.edit: " . $th . today());
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
            $tipo_informacion = Tipo_informacion::find($id);

            if ($tipo_informacion->id_estatus == 1) {
                $tipo_informacion->id_estatus = 2;
            } else {
                $tipo_informacion->id_estatus = 1;
            }

            $tipo_informacion->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tipo_informacion.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    
}
