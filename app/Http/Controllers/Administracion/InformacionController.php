<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Informacion;
use App\Models\Administracion\Tipo_informacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InformacionController extends Controller
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
            return response()->json(view('administracion.informacion.listado')->render());
        }
        $informacion =Informacion::pluck('descripcion','id_informacion');
        $tipo_informacion = Tipo_informacion::pluck('descripcion','id_tipo_informacion');

        return view('administracion.informacion.index', compact('tipo_informacion', 'informacion' ));
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
            'descripcion' => 'required|unique:informacion|max:25|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',
        ];

        $messages = [
            'descripcion.required' => 'El informacion es obligatorio.',
            'descripcion.max' => 'El informacion el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El informacion ya esta registrado.',
			'descripcion.alpha' => 'El informacion debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {

            $informacion = new Informacion();
            $informacion->descripcion = Str::upper($request->get('descripcion'));
            $informacion->id_tipo_informacion = $request->get('tipo_informacion');
            $informacion->save();

             return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en informacion.store: " . $th);
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
        $informacion = Informacion::find($id);
        return response()->json(view('administracion.informacion.show', compact('informacion'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $informacion = Informacion::find($id);
        $tipo_informacion = Tipo_informacion::pluck('descripcion','id_tipo_informacion');
        return response()->json(view('administracion.informacion.edit', compact('tipo_informacion','informacion'))->render());
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
            'descripcion' => 'required|unique:informacion,descripcion,' . $id . ',id_informacion|max:100|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)',

        ];

        $messages = [
            'descripcion.required' => 'El informacion es obligatorio.',
            'descripcion.max' => 'El tipo de informacion el máximo de caracteres permitidos.',
            'descripcion.unique' => 'El informacion ya esta registrado.',
			'descripcion.alpha' => 'El informacion debe contener solo letras.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        try {
            $informacion = Informacion::find($id);
            $informacion->descripcion = Str::upper($request->get('descripcion'));
            $tipo_informacion = Tipo_informacion::pluck('descripcion','id_tipo_informacion');
            $informacion->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en informacion.edit: " . $th . today());
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
            $informacion = informacion::find($id);

            if ($informacion->id_estatus == 1) {
                $informacion->id_estatus = 2;
            } else {
                $informacion->id_estatus = 1;
            }

            $informacion->save();

            return response()->json(['mensaje' => 'success'], 200);
        } catch (\Throwable $th) {
            Log::error("Error en informacion.destroy: " . $th . today());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }

    public function getInformacionesByTipos(Request $request){

        $InformacionesByTipos=Informacion::where('id_tipo_informacion',$request->tipo_informacion)->orderBy('descripcion','ASC')->pluck('descripcion','id_informacion');
        return $InformacionesByTipos;

    }
}
