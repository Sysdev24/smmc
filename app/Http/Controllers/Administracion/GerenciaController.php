<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Gerencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GerenciaController extends Controller
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
			return response()->json(view('administracion.gerencia.listado')->render());
        }

        return view('administracion.gerencia.index');
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
            'descripcion' => 'required|unique:gerencia|max:25',
        ];

        $messages = [
            'descripcion.required' => 'El nombre del cargo es obligatorio.',
            'descripcion.unique' => 'El cargo ya está registrada.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $gerencia = new Gerencia();
            $gerencia->descripcion = Str::upper($request->get('descripcion'));
            $gerencia->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en la gerencia.store: " . $th);
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
        $gerencia = Gerencia::find($id);
        return response()->json(view('administracion.gerencia.show', compact('gerencia'))->render());
    }
	
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $gerencia = Gerencia::find($id);
        return response()->json(view('administracion.gerencia.edit', compact('gerencia'))->render());
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
            'descripcion' => 'required|unique:gerencia,descripcion,' . $id . ',id_gerencia|max:25',
        ];

        $messages = [
            'descripcion.required' => 'El nombre del cargo es obligatorio.',
            'descripcion.unique' => 'El cargo ya está registrado.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $gerencia = Gerencia::find($id);
            $gerencia->descripcion = Str::upper($request->get('descripcion'));
            $gerencia->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en la gerencia.store: " . $th . today());
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
            $gerencia = Gerencia::find($id);

            if ($gerencia->id_estatus = 1) {
                $gerencia->id_estatus = 2;
            } else {
                $gerencia->id_estatus = 1;
            }

            $gerencia->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en la gerencia.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
