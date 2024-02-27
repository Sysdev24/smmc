<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Estatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EstatusController extends Controller
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
            return response()->json(view('administracion.estatus.listado')->render());
        }

        return view('administracion.estatus.index');
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
            'descripcion' => 'required|unique:estatus|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El estatus es obligatorio.',
            'descripcion.max' => 'El estatus el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El estatus ya esta registrado.',
			'descripcion.alpha' => 'El estatus debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $estatus = new Estatus();
            $estatus->descripcion = Str::upper($request->get('descripcion'));
            $estatus->siglas = Str::upper($request->get('siglas'));
            $estatus->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en estatus.store: " . $th);
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
        $estatus = Estatus::find($id);
        return response()->json(view('administracion.estatus.show', compact('estatus'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estatus = Estatus::find($id);
        return response()->json(view('administracion.estatus.edit', compact('estatus'))->render());
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
            'descripcion' => 'required|unique:estatus,descripcion,' . $id . ',id_estatus|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'El estatus es obligatorio.',
            'descripcion.max' => 'El tipo de estatus el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El estatus ya esta registrado.',
			'descripcion.alpha' => 'El estatus debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $estatus = Estatus::find($id);
            $estatus->descripcion = Str::upper($request->get('descripcion'));
            $estatus->siglas = Str::upper($request->get('siglas'));
            $estatus->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en estatus.edit: " . $th . today());
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
            $estatus = Estatus::find($id);

            if ($estatus->id_estatus == 1) {
                $estatus->id_estatus = 2;
            } else {
                $estatus->id_estatus = 1;
            }

            $estatus->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en estatus.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
