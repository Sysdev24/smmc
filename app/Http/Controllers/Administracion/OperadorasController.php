<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Operadoras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OperadorasController extends Controller
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
            return response()->json(view('administracion.operadoras.listado')->render());
        }

        return view('administracion.operadoras.index');
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
            'descripcion' => 'required|unique:operadoras|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El nombre de la operadora es obligatorio.',
            'descripcion.unique' => 'La operadora ya está registrado.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
			'descripcion.alpha' => 'La operadora debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $operadoras = new Operadoras();
            $operadoras->descripcion = Str::upper($request->get('descripcion'));
            $operadoras->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en operadora.store: " . $th);
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
        $operadoras = Operadoras::find($id);
        return response()->json(view('administracion.operadoras.show', compact('operadoras'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $operadoras = Operadoras::find($id);
        return response()->json(view('administracion.operadoras.edit', compact('operadoras'))->render());
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
            'descripcion' => 'required|unique:operadoras,descripcion,' . $id . ',id_operadora|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El nombre de la operadora es obligatorio.',
            'descripcion.unique' => 'La operadora ya está registrado.',
            'descripcion.max' => 'El nombre superó el máximo de caracteres permitidos.',
			'descripcion.alpha' => 'La operadora debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $operadoras = Operadoras::find($id);
            $operadoras->descripcion = Str::upper($request->get('descripcion'));
            $operadoras->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en operadora.edit: " . $th . today());
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
            $operadoras = Operadoras::find($id);

            if ($operadoras->id_estatus == 1) {
                $operadoras->id_estatus = 2;
            } else {
                $operadoras->id_estatus = 1;
            }

            $operadoras->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en operadora.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
