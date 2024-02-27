<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Redes_sociales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Redes_socialesController extends Controller
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
            return response()->json(view('administracion.redes_sociales.listado')->render());
        }

        return view('administracion.redes_sociales.index');
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
            'descripcion' => 'required|unique:redes_sociales|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'La red social  es obligatorio.',
            'descripcion.max' => 'La red social el máximo de caracteres permitidos.',
            'descripcion.unique' => 'La red social ya esta registrado.',
			'descripcion.alpha' => 'La red social debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $redes_sociales = new Redes_sociales();
            $redes_sociales->descripcion = Str::upper($request->get('descripcion'));
            $redes_sociales->save();

             return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en redes_sociales.store: " . $th);
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
        $redes_sociales = Redes_sociales::find($id);
        return response()->json(view('administracion.redes_sociales.show', compact('redes_sociales'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $redes_sociales = Redes_sociales::find($id);
        return response()->json(view('administracion.redes_sociales.edit', compact('redes_sociales'))->render());
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
            'descripcion' => 'required|unique:redes_sociales,descripcion,' . $id . ',id_redes_sociales|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'La red social es obligatorio.',
            'descripcion.max' => 'La red social el máximo de caracteres permitidos.',
            'descripcion.unique' => 'La red social ya esta registrado.',
			'descripcion.alpha' => 'La red social debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $redes_sociales = Redes_sociales::find($id);
            $redes_sociales->descripcion = Str::upper($request->get('descripcion'));
            $redes_sociales->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en redes_sociales.edit: " . $th . today());
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
            $redes_sociales = Redes_sociales::find($id);

            if ($redes_sociales->id_estatus == 1) {
                $redes_sociales->id_estatus = 2;
            } else {
                $redes_sociales->id_estatus = 1;
            }

            $redes_sociales->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en redes_sociales.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
