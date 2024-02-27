<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Cargo;
use App\Models\Administracion\Gerencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PersonalController extends Controller
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
            return response()->json(view('administracion.personal.listado')->render());
        }
        $cargo = Cargo::pluck('descripcion', 'id_cargo');
        $gerencia = Gerencia::pluck('descripcion', 'id_gerencia');
        return view('administracion.personal.index', compact('cargo', 'gerencia'));
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
            'ci' => 'required|numeric|unique:personal',
            'nombre' => 'required|max:40',
            'apellido' => 'required|max:40',
            'nro_empleado' => 'required|max:10',
        ];

        $messages = [
            'ci.required' => 'La cédula es obligatoria.',
            'ci.numeric' => 'La cédula debe ser un valor numérico.',
            'ci.unique' => 'La cédula ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre superó el máximo de caracteres permitidos.',
            'nombre.alpha' => 'El nombre debe contener solo letras.',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'El apellido superó el máximo de caracteres permitidos.',
            'apellido.alpha' => 'El apellido debe contener solo letras.',
            'nro_empleado.required' => 'El numero de empleado es obligatorio.',
        ];

         $validator = Validator::make($request->all(), $rules, $messages)->validate(); 

        try {

            $personal = new Personal();

            $personal->ci = $request->get('ci');
            $personal->nombre = Str::upper($request->get('nombre'));
            $personal->apellido = Str::upper($request->get('apellido'));
            $personal->nro_empleado = $request->get('nro_empleado');
            $personal->id_gerencia = $request->get('gerencia');
	        $personal->id_cargo = $request->get('cargo');

            $personal->save();
            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en personal.store: " . $th);
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
        $personal = Personal::find($id);
        return response()->json(view('administracion.personal.show', compact('personal'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $personal = Personal::find($id);
        $gerencia = Gerencia::pluck('descripcion', 'id_gerencia');
        $cargo = Cargo::pluck('descripcion', 'id_cargo'); 
        return response()->json(view('administracion.personal.edit', compact('personal', 'gerencia','cargo'))->render());
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
            'ci' => 'required|numeric',
            'nombre' => 'required|max:40|alpha',
            'apellido' => 'required|max:40|alpha',
            'nro_empleado' => 'required|max:10',
        ];

        $messages = [
            'ci.required' => 'La cédula es obligatoria.',
            'ci.numeric' => 'La cédula debe ser un valor numérico.',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre superó el máximo de caracteres permitidos.',
            'nombre.alpha' => 'El nombre debe contener solo letras.',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'El apellido superó el máximo de caracteres permitidos.',
            'apellido.alpha' => 'El apellido debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $personal = personal::find($id);
           /*  $personal = Personal::where('id_personal', $id)->first(); */
            $personal->ci = $request->get('ci');
            $personal->nombre = Str::upper($request->get('nombre'));
            $personal->apellido = Str::upper($request->get('apellido'));
            $personal->nro_empleado = $request->get('nro_empleado');
            $personal->id_gerencia = $request->get('gerencia');
	        $personal->id_cargo = $request->get('cargo');
            $personal->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en personal.edit: " . $th . today());
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
            $personal = Personal::find($id);

            if ($personal->id_estatus == 1) {
                $personal->id_estatus = 2;
            } else {
                $personal->id_estatus = 1;
            }

            $personal->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en personal.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }
}
