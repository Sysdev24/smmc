<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Tipo_evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Tipo_eventoController extends Controller
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
            return response()->json(view('administracion.tipo_evento.listado')->render());
        }

        return view('administracion.tipo_evento.index');
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
            'descripcion' => 'required|unique:tipo_evento|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El Proceso relacionado es obligatorio.',
            'descripcion.max' => 'El Proceso relacionado el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El Proceso relacionado ya esta registrado.',
			'descripcion.alpha' => 'El Proceso relacionado debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $tipo_evento = new Tipo_evento();
            $tipo_evento->descripcion = Str::upper($request->get('descripcion'));
            $tipo_evento->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tipo_evento.store: " . $th);
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
        $tipo_evento = Tipo_evento::find($id);
        return response()->json(view('administracion.tipo_evento.show', compact('tipo_evento'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_evento = Tipo_evento::find($id);
        return response()->json(view('administracion.tipo_evento.edit', compact('tipo_evento'))->render());
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
            'descripcion' => 'required|unique:tipo_evento,descripcion,' . $id . ',id_tipo_evento|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'El proceso relacionado es obligatorio.',
            'descripcion.max' => 'El tipo de proceso relacionado el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El proceso relacionado ya esta registrado.',
			'descripcion.alpha' => 'El proceso relacionado debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $tipo_evento = Tipo_evento::find($id);
            $tipo_evento->descripcion = Str::upper($request->get('descripcion'));
            $tipo_evento->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tipo_evento.edit: " . $th . today());
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
            $tipo_evento = Tipo_evento::find($id);

            if ($tipo_evento->id_estatus == 1) {
                $tipo_evento->id_estatus = 2;
            } else {
                $tipo_evento->id_estatus = 1;
            }

            $tipo_evento->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tipo_evento.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
