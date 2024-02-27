<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Tendencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TendenciaController extends Controller
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
            return response()->json(view('administracion.Tendencia.listado')->render());
        }

        return view('administracion.tendencia.index');
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
            'descripcion' => 'required|unique:tendencia|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El tendencia es obligatorio.',
            'descripcion.max' => 'El tendencia el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El tendencia ya esta registrado.',
			'descripcion.alpha' => 'El tendencia debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $tendencia = new Tendencia();
            $tendencia->descripcion = Str::upper($request->get('descripcion'));
            $tendencia->save();

             return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tendencia.store: " . $th);
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
        $tendencia = Tendencia::find($id);
        return response()->json(view('administracion.tendencia.show', compact('tendencia'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tendencia = Tendencia::find($id);
        return response()->json(view('administracion.tendencia.edit', compact('tendencia'))->render());
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
            'descripcion' => 'required|unique:tendencia,descripcion,' . $id . ',id_tendencia|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'El tendencia es obligatorio.',
            'descripcion.max' => 'El tipo de tendencia el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El tendencia ya esta registrado.',
			'descripcion.alpha' => 'El tendencia debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $tendencia = Tendencia::find($id);
            $tendencia->descripcion = Str::upper($request->get('descripcion'));
            $tendencia->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tendencia.edit: " . $th . today());
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
            $tendencia = Tendencia::find($id);

            if ($tendencia->id_estatus == 1) {
                $tendencia->id_estatus = 2;
            } else {
                $tendencia->id_estatus = 1;
            }

            $tendencia->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en tendencia.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
