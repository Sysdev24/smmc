<?php

namespace App\Http\Controllers\Visitantes;

use DateTime;
use Exception;
use App\Rules\Passport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Visitantes\Visitante;
use Illuminate\Support\Facades\Auth;
use App\Models\Administracion\Personal;
use App\Models\Administracion\Estado;
use function PHPUnit\Framework\isNull;
use App\Models\Administracion\Operadora;
use Illuminate\Support\Facades\Plan;
use App\Models\Administracion\Gerencia;
use App\Http\Controllers\Controllers_Generic\LDAPController;



class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return redirect(route('home'));
        return view('visitantes.registrar-visitantes.index');
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        try {

                    $newVisitante = Visitante::create([

                        'id_personal' =>  $request->get('personal'),
                        'id_operadora' => $request->get('operadora'),
                        'id_plan' => $request->get('plan'),
                        'nro_tlf' => $request->get('nro_tlf'),
                        'cuenta_uso' => $request->get('cuenta_uso'),
                        'id_estatus' => $request->get('estatus'),
                        'observacion' => $request->get('observacion')

                    ]);

        } catch (\Throwable $th) {

            Log::error("Error en VisitanteController.store:" .  $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
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
        $visitante = Visitante::find($id);

        return view('visitantes.registrar-visitantes.show')
            ->with('visitante', $visitante)
           // ->with('fotoVisitante', !empty($fotoVisitante) ? $fotoVisitante['imgBase64'] : null)
            ->render();
    }



    /**
     * *Show the form for editing the specified resource.
     *
     * @param  int  $id  'created_at',
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitante = Visitante::find($id);
        $fotoVisitante = $this->getPhoto(explode('-', $visitante->ci_pasaporte)[1], explode('-', $visitante->ci_pasaporte)[0]);

        $equipos = Equipo::where('ci_pasaporte', $visitante->ci_pasaporte)->where('salio', false)->get();

        if (count($fotoVisitante) > 0 && is_array($fotoVisitante['imgBase64'])) {

            foreach ($fotoVisitante['imgBase64'] as $foto) {
                if (in_array($visitante->nombres, json_decode(json_encode($foto), true))) {

                    $fotoVisitante['imgBase64'] = json_decode(json_encode($foto), true)['photo'];
                }
            }
        }

        return view('visitantes.registrar-visitantes.salida-visitante')
            ->with('visitante', $visitante)
            ->with('equipos', $equipos)
            ->with('fotoVisitante', !empty($fotoVisitante) ? $fotoVisitante['imgBase64'] : null)
            ->render();
    }



    /**
     * *Muestra el formulario para editar el visitante.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarVisitante($id)
    {
        $visitante = Visitante::find($id);
        $equiposVisitante = Equipo::where('id_visitante', $id)->get();

        $tipoVisitante =  [" " => ""] +  json_decode(json_encode(TipoVisitante::where('id_status', 1)->orderBy('descripcion', 'asc')->get()->pluck('descripcion', 'id_tipo_visitante')), true);
        $codArea =  json_decode(json_encode(CodigoArea::where('id_status', 1)->get()->pluck('codigo_area', 'codigo_area')), true);

        $carnets =  Carnet::where('id_status', 1)->where('asignado', false)->where('id_centro_trabajo', Auth::user()->id_centro_trabajo)->orderBy('carnet', 'asc')->get()->pluck('carnet', 'carnet');
        $carnets[$visitante->no_carnet_asignado] = $visitante->no_carnet_asignado;
        $carnets =  ["" => ""] + json_decode(json_encode($carnets), true);

        $motivoVisita = ["" => ""] + json_decode(json_encode(MotivoVisita::where('id_status', 1)->orderBy('descripcion', 'asc')->get()->pluck('descripcion', 'id_motivo_visita')), true);
        $destinoVisitante = ["" => ""] + json_decode(json_encode(DestinoCentroTrabajo::where('id_status', 1)->where('id_centro_trabajo', Auth::user()->id_centro_trabajo)->orderBy('destino', 'asc')->get()->pluck('destino', 'id_destino')), true);

        $fotoVisitante = $this->getPhoto(explode('-', $visitante->ci_pasaporte)[1], explode('-', $visitante->ci_pasaporte)[0]);

        return view('visitantes.registrar-visitantes.edit')
            ->with('visitante', $visitante)
            ->with('tipoVisitante', $tipoVisitante)
            ->with('codArea', $codArea)
            ->with('carnets', $carnets)
            ->with('motivoVisita', $motivoVisita)
            ->with('destinoVisitante', $destinoVisitante)
            ->with('dataSource', 'DB')
            ->with('count', 1)
            ->render();
    }




    public function updateVisitante(Request $request, $id)
    {
        $this->validateRequest($request);

        try {

            if ($this->uploadImage($request->get('imagen'), $request->get('img-base64'), $request->get('tipo_dcumento_visitado'), $request->get('ci_pasaporte'))) {

                $rest = DB::transaction(function () use ($request, $id) {

                    $autoriza = '';
                    $ciAutoriza = '';

                    if ($request->get('autoriza_tipo') === 'visitado') {

                        $autoriza = $request->get('visitado');
                        $ciAutoriza = $request->get('tipo_dcumento_visitado') . '-' . $request->get('ci_pasaporte_visitado');
                    } else {

                        $autoriza = $request->get('autoriza');
                        $ciAutoriza = $request->get('tipo_dcumento_autoriza') . '-' . $request->get('ci_autoriza');
                    }

                    $visitante = Visitante::find($id);
                    if ($visitante->no_carnet_asignado != $request->get('carnet')) {
                        Carnet::where('carnet', $request->get('carnet'))->update(['asignado' => true]);
                        Carnet::where('carnet', $visitante->no_carnet_asignado)->update(['asignado' => false]);
                    }

                    Visitante::where('id_registro', $id)->update([

                        'id_personal' => $request->get('personal'),
                        'id_operadora' => $request->get('operadora'),
                        'id_plan' => $request->get('plan'),
                        'nro_tlf' => $request->get('nro_tlf'),
                        'cuenta_uso' => $request->get('cuenta_uso'),
                        'id_estatus' => $request->get('estatus'),
                        'observacion' => $request->get('observacion')

                    ]);

                    if ($request->_equipos === 'true') {

                        foreach ($request->equipos as $equipo) {

                            if (intval(json_decode(json_encode($equipo))->id_equipo) === 0) {

                                Equipo::create([

                                    'descripcion_equipo' => json_decode(json_encode($equipo))->descripcion_equipo,
                                    'observacion' => json_decode(json_encode($equipo))->observacion,
                                    'serial' => json_decode(json_encode($equipo))->serial,
                                    'entro' => true,
                                    'ci_pasaporte' => $request->get('tipo_dcumento') . '-' . $request->get('ci_pasaporte'),
                                    'id_visitante' => $id

                                ]);
                            } else {

                                Equipo::where('id_equipo', json_decode(json_encode($equipo))->id_equipo)->update([

                                    'descripcion_equipo' => json_decode(json_encode($equipo))->descripcion_equipo,
                                    'observacion' => json_decode(json_encode($equipo))->observacion,
                                    'serial' => json_decode(json_encode($equipo))->serial,
                                    'entro' => true,
                                    'ci_pasaporte' => $request->get('tipo_dcumento') . '-' . $request->get('ci_pasaporte'),
                                    'id_visitante' => $id

                                ]);
                            }
                        }
                    }


                    if ($request->_delEquipos === 'true') {

                        foreach ($request->delEquipos as $delEquipo) {

                            Equipo::destroy($delEquipo);
                        }
                    }
                });



                return response()->json(['mensaje' => $rest], 200);
            } else {

                return response()->json(['mensaje' => 'Error en VisitanteController.store.uploadImage'], 500);
            }
        } catch (\Throwable $th) {

            Log::error("Error en VisitanteController.updateVisitante:" .  $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }
    }






    /**
     * *Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        try {

            $visitante = Visitante::find($id);

            if (!$request->has('equipos')) { //*No esta retirando los equipos

                $result = $this->registrarSalidadeVisitante($id, $visitante->carnet->carnet);
            } else {
                $result = $this->registrarSalidadeVisitante($id, $visitante->carnet->carnet, $request->equipos);
            }

            if ($result->getData()->isOK) {

                return response()->json(['mensaje' => 'OK'], 200);
            } else {

                throw new Exception($result->getData()->msg);
            }
        } catch (\Throwable $th) {

            Log::error("Error en VisitanteController.update " . $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            return response()->json(['mensaje' => 'Error interno'], 500);
        }

        //!return response()->json(['mensaje' => 'Error en VisitanteController.update'.$id, 'request'=>filter_var($request->retiraTodo,FILTER_VALIDATE_BOOLEAN)], 200);
    }




    /**
     * *Actuliza la hora de salida del visitantes
     * @param Visitante $visitante
     */
    protected function registrarSalidadeVisitante($id, $carnet, $equipos = [])
    {

        return DB::transaction(function () use ($id, $carnet, $equipos) {

            try {

                if (!empty($equipos)) {

                    foreach ($equipos as $equipo) {

                        $visitanteEquiop = Equipo::find($equipo);

                        $visitanteEquiop->where('id_equipo', $equipo)->update([
                            'salio' => true,
                            'fecha_hora_salida' => new DateTime(),
                        ]);

                        /* if ($id == $visitanteEquiop->id_visitante) {

                            $visitanteEquiop->where('id_equipo', $equipo)->update([
                                'salio' => true,
                            ]);
                        } else {

                            Equipo::create([

                                'descripcion_equipo' =>  $visitanteEquiop->descripcion_equipo,
                                'observacion' =>  $visitanteEquiop->observacion,
                                'serial' =>  $visitanteEquiop->serial,
                                'entro' => false,
                                'salio' => true,
                                'ci_pasaporte' => $visitanteEquiop->ci_pasaporte,
                                'id_visitante' => $id,

                            ]);
                        } */
                    }
                }

                Visitante::where('id_visitante', $id)->update([
                    'fecha_hora_salida' => new DateTime(),
                    'id_opetador_salida' => Auth::user()->id_usuario
                ]);

                Carnet::where('carnet', $carnet)->update(['asignado' => false]);

                return response()->json(['isOK' => true, 'msg' => null], 200);
            } catch (\Throwable $th) {

                return response()->json(['isOK' => false, 'msg' => $th->getMessage() . ' en ' . $th->getFile() . ' linea ' . $th->getLine()], 500);
            }
        });
    }

    /**
     * Retorna el visitante por el némuro de cédula.
     *
     * @param \Illuminate\Http\Request $request
     * @return int|string|void
     */

    public function consultarVisitante(Request $request)
    {

        try {

            request()->request->add(['ci_pasaporte' => $request->get('tipoDocumento') . '-' . $request->get('ciPasaporte')]);

            $tipoVisitante =  [" " => ""] +  json_decode(json_encode(TipoVisitante::where('id_status', 1)->orderBy('descripcion', 'asc')->get()->pluck('descripcion', 'id_tipo_visitante')), true);
            $codArea =  json_decode(json_encode(CodigoArea::where('id_status', 1)->get()->pluck('codigo_area', 'codigo_area')), true);
            $carnets = ["" => ""] + json_decode(json_encode(Carnet::where('id_status', 1)->where('id_centro_trabajo', Auth::user()->id_centro_trabajo)->where('asignado', false)->orderBy('carnet', 'asc')->get()->pluck('carnet', 'carnet')), true);
            $motivoVisita = ["" => ""] + json_decode(json_encode(MotivoVisita::where('id_status', 1)->orderBy('descripcion', 'asc')->get()->pluck('descripcion', 'id_motivo_visita')), true);
            $destinoVisitante = ["" => ""] + json_decode(json_encode(DestinoCentroTrabajo::where('id_status', 1)->where('id_centro_trabajo', Auth::user()->id_centro_trabajo)->orderBy('destino', 'asc')->get()->pluck('destino', 'id_destino')), true);

            $fotoVisitante = $this->getPhoto($request->get('ciPasaporte'), $request->get('tipoDocumento'));

            $restringido = VisitanteRestringido::where('ci_pasaporte', $request->get('ci_pasaporte'))->where('id_status', 1)->get();
            if (count($restringido) > 0) {

                return response()->json(['status' => 'restricted', 'data' => null], 200);
            } else {

                $datosVisitantes = Visitante::where('ci_pasaporte', $request->get('ci_pasaporte'))->orderBy('id_visitante', 'desc')->first();

                if ($datosVisitantes) {

                    if ($datosVisitantes->fecha_hora_salida != "") {

                        if (count($fotoVisitante) > 0) {

                            if (is_array($fotoVisitante['imgBase64'])) {

                                foreach ($fotoVisitante['imgBase64'] as $foto) {
                                    if (in_array($datosVisitantes->nombres, json_decode(json_encode($foto), true))) {
                                        $fotoVisitante['imgBase64'] = json_decode(json_encode($foto), true)['photo'];
                                    }
                                }
                            }
                        }


                        return view('visitantes.registrar-visitantes.create')
                            ->with('ciPasaporte', $request->get('ci_pasaporte'))
                            ->with('datosVistante', $datosVisitantes)
                            ->with('pathImg', empty($fotoVisitante) ? null : $fotoVisitante['path'])
                            ->with('photo', empty($fotoVisitante) ? null : $fotoVisitante['imgBase64'])
                            ->with('tipoVisitante', $tipoVisitante)
                            ->with('codArea', $codArea)
                            ->with('carnets', $carnets)
                            ->with('motivoVisita', $motivoVisita)
                            ->with('destinoVisitante', $destinoVisitante)
                            ->with('dataSource', 'DB')
                            ->with('count', 1)
                            ->render();
                    } else {

                        return response()->json(['status' => 'inside', 'data' => $datosVisitantes], 200);
                    }
                } else {

                    $datosVisitantes = HistoricoVisitante::where('ci_pasaporte', $request->get('ci_pasaporte'))->orderBy('id_visitante', 'desc')->first();

                    if ($datosVisitantes) {

                        if (is_array($fotoVisitante['imgBase64'])) {

                            foreach ($fotoVisitante['imgBase64'] as $foto) {
                                if (in_array($datosVisitantes->nombres, json_decode(json_encode($foto), true))) {

                                    $fotoVisitante['imgBase64'] = json_decode(json_encode($foto), true)['photo'];
                                }
                            }
                        }

                        return view('visitantes.registrar-visitantes.create')
                            ->with('ciPasaporte', $request->get('ci_pasaporte'))
                            ->with('datosVistante', $datosVisitantes)
                            ->with('pathImg', empty($fotoVisitante) ? null : $fotoVisitante['path'])
                            ->with('photo', empty($fotoVisitante) ? null : $fotoVisitante['imgBase64'])
                            ->with('tipoVisitante', $tipoVisitante)
                            ->with('codArea', $codArea)
                            ->with('carnets', $carnets)
                            ->with('motivoVisita', $motivoVisita)
                            ->with('dataSource', 'DB')
                            ->with('destinoVisitante', $destinoVisitante)
                            ->with('count', 1)
                            ->render();
                    } else {

                        if ($request->tipoDocumento === 'V') {

                            $datosVisitantes = LDAPController::consultarDatosUsuarioLDAPXCedula($request->get('ciPasaporte'))->original;
                            $datosVisitantes = json_decode(json_encode($datosVisitantes));

                            if (count($datosVisitantes->data) === 1) {

                                return view('visitantes.registrar-visitantes.create')

                                    ->with('ciPasaporte', $request->get('ci_pasaporte'))
                                    ->with('datosVistante', $datosVisitantes->data[0])
                                    ->with('pathImg', empty($fotoVisitante) ? null : $fotoVisitante['path'])
                                    ->with('photo', empty($fotoVisitante) ? null : $fotoVisitante['imgBase64'])
                                    ->with('tipoVisitante', $tipoVisitante)
                                    ->with('codArea', $codArea)
                                    ->with('carnets', $carnets)
                                    ->with('motivoVisita', $motivoVisita)
                                    ->with('destinoVisitante', $destinoVisitante)
                                    ->with('dataSource', 'LDAP')
                                    ->with('count', count($datosVisitantes->data))
                                    ->render();
                            } else {

                                return view('visitantes.registrar-visitantes.create')
                                    ->with('ciPasaporte', $request->get('ci_pasaporte'))
                                    ->with('datosVistante', $datosVisitantes->data)
                                    ->with('pathImg', empty($fotoVisitante) ? null : $fotoVisitante['path'])
                                    ->with('photo', empty($fotoVisitante) ? null : $fotoVisitante['imgBase64'])
                                    ->with('tipoVisitante', $tipoVisitante)
                                    ->with('codArea', $codArea)
                                    ->with('carnets', $carnets)
                                    ->with('motivoVisita', $motivoVisita)
                                    ->with('destinoVisitante', $destinoVisitante)
                                    ->with('dataSource', 'LDAP')
                                    ->with('count', count($datosVisitantes->data))
                                    ->render();
                            }
                        }

                        return view('visitantes.registrar-visitantes.create')
                            ->with('ciPasaporte', $request->get('ci_pasaporte'))
                            ->with('datosVistante', $datosVisitantes)
                            ->with('pathImg', empty($fotoVisitante) ? null : $fotoVisitante['path'])
                            ->with('photo', empty($fotoVisitante) ? null : $fotoVisitante['imgBase64'])
                            ->with('tipoVisitante', $tipoVisitante)
                            ->with('codArea', $codArea)
                            ->with('carnets', $carnets)
                            ->with('motivoVisita', $motivoVisita)
                            ->with('destinoVisitante', $destinoVisitante)
                            ->with('dataSource', 'BD')
                            ->with('count', 0)
                            ->render();
                    }
                }
            }
        } catch (\Throwable $th) {

            Log::error("Error en VisitanteController.consultarVisitante:" . $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            return response()->json(['status' => 'error', 'data' => null], 500);
        }
    }







    /**
     * *Retorna la foto del visitante si se encuatra
     * @param string $cedula
     * @return array infoImagen[]
     */

    public static function getPhoto(String  $cedula, String $tipoDoc)
    {
        $infoImagen = array();
        $photo = array();

        if (file_exists(public_path() . '/img/foto_visitante/' . $tipoDoc . '-' . $cedula . '.png')) {

            $infoImagen['path'] = 'img/foto_visitante/' . $tipoDoc . '-' . $cedula . '.png';
            $infoImagen['imgBase64'] = base64_encode(file_get_contents(public_path() . '/img/foto_visitante/' . $tipoDoc . '-' . $cedula . '.png'));
        } else {

            if ($tipoDoc === 'V') {

                $datosVisitantes = LDAPController::consultarDatosUsuarioLDAPXCedula($cedula)->original;

                if (count($datosVisitantes['data']) == 1) {

                    $infoImagen['path'] = '';
                    $infoImagen['imgBase64'] = $datosVisitantes['data'][0]['photo'];
                } else if (count($datosVisitantes['data'])  > 1) {

                    foreach ($datosVisitantes['data'] as $value) {

                        array_push($photo, $value);
                    }

                    $infoImagen['path'] = '';
                    $infoImagen['imgBase64'] = $photo;
                }
            }
        }

        return $infoImagen;
    }






    protected function validateRequest(Request $request)
    {
        request()->request->add(['nro_telefono' => $request->get('cod_telefono') . '-' . $request->get('telefono')]);

        $rules = [

            'ci_pasaporte' => 'max:15',
            'nombres' => 'required|max:20',
            'telefono' => 'required|numeric|digits_between:1,7|max:9999999',
            'apellidos' => 'required|max:20',
            'tipo_visitante' => 'required',
            'carnet' => 'required',
            'procedencia' => 'max:30',
            'motivo_visita' => 'required',
            'destino_visitante' => 'required',
            'visitado' => 'required|max:45',
            'observacion' => 'max:300',
            //'ci_pasaporte_visitado' => 'required|max:15',
        ];

        $messages = [
            '' => '',
            'nombres.required' => 'El nombre es obligatorio',
            'nombres.max' => 'Excedió el máximo de caracteres permitidos.',
            'apellidos.required' => 'El apellido es obligatorio',
            'apellidos.max' => 'Excedió el máximo de caracteres permitidos.',
            'telefono.required' => 'El teléfono es obligatorio',
            'telefono.digits_between' => 'Excedió el máximo de caracteres.',
            'telefono.numeric' => 'Debe ser un valor numérico',
            'tipo_visitante.required' => 'El tipo de visitante es obligatorio',
            'carnet.required' => 'El carnet es obligatorio',
            'procedencia.max' => 'Excedió el máximo de caracteres permitidos.',
            'motivo_visita.required' => 'El motivo del visitante es obligatorio',
            'destino_visitante.required' => 'El destino del visitante es obligatorio',
            //'ci_pasaporte_visitado.required' => 'La cédula es obligatoria',
            //'ci_pasaporte_visitado.max' => 'Excedió el máximo de caracteres permitidos.',
            'visitado.required' => 'El nombre es obligatorio',
            'visitado.max' => 'Excedió el máximo de caracteres permitidos.',
            'observacion.max' => 'Excedió el máximo de caracteres permitidos.',
        ];


        /**
         * *Validaciones para la cédula del vistante.
         */
        if ($request->get('tipo_dcumento') === 'V' || $request->get('tipo_dcumento') === 'E') {

            $rules['ci_pasaporte'] = ['required', 'numeric', 'max:99999999', 'min:1'];

            $messages['ci_pasaporte.numeric'] = 'La CI debe ser un valor numérico';
            $messages['ci_pasaporte.max'] = 'La CI superó el valor máximo permitido.';
            $messages['ci_pasaporte.min'] = 'El valor ingresado no está permitido.';
            $messages['ci_pasaporte.required'] = 'La cédula es obligatoria.';
        } else {

            $rules['ci_pasaporte'] = ['required', 'max:13', new Passport];

            $messages['ci_pasaporte.max'] = 'Superó el máximo de caracteres permitido.';
        }




        /**
         * *Validaciones para la cédula del visitado.
         */

        if ($request->get('tipo_dcumento_visitado') === 'V' || $request->get('tipo_dcumento_visitado') === 'E') {
            $rules['ci_pasaporte_visitado'] = ['required', 'numeric', 'max:99999999', 'min:1'];

            $messages['ci_pasaporte_visitado.numeric'] = 'La CI debe ser un valor numérico';
            $messages['ci_pasaporte_visitado.max'] = 'Excedió el valor máximo permitido.';
            $messages['ci_pasaporte_visitado.min'] = 'El valor ingresado no está permitido.';
            $messages['ci_pasaporte_visitado.required'] = 'La cédula es obligatoria.';
        } else {

            $rules['ci_pasaporte_visitado'] = ['required', 'max:13', new Passport];


            $messages['ci_pasaporte_visitado.max'] = 'Excedió el máximo de caracteres permitidos.';
            $messages['ci_pasaporte_visitado.required'] = 'La CI es obligatoria';
            $messages['ci_pasaporte_visitado.required'] = 'La cédula es obligatoria.';
        }




        /**
         * *Validaciones para la cédula de la persona que autoriza.
         */

        if ($request->get('autoriza_tipo') === 'otro') {

            $rules['autoriza'] = ['required', 'max:45'];

            $messages['autoriza.required'] = 'La nombre es obligatorio.';
            $messages['autoriza.max'] = 'Excedió el máximo de caracteres permitidos.';

            if ($request->get('tipo_dcumento_autoriza') === 'V' || $request->get('tipo_dcumento_autoriza') === 'E') {

                $rules['ci_autoriza'] = ['required', 'numeric', 'max:99999999', 'min:1'];

                $messages['ci_autoriza.numeric'] = 'La CI debe ser un valor numérico';
                $messages['ci_autoriza.max'] = 'Excedió el valor máximo permitido.';
                $messages['ci_autoriza.min'] = 'El valor ingresado no está permitido.';
                $messages['ci_autoriza.required'] = 'La cédula es obligatoria.';
            } else {


                $rules['ci_autoriza'] = ['required', 'max:13', new Passport];

                $messages['ci_autoriza.max'] = 'Excedió el máximo de caracteres permitidos.';
                $messages['ci_autoriza.required'] = 'La CI es obligatoria';
                $messages['ci_autoriza.required'] = 'La cédula es obligatoria.';
            }
        }

        $request->validate($rules, $messages);
    }
}
