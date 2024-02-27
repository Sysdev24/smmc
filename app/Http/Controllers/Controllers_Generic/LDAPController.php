<?php

namespace App\Http\Controllers\Controllers_Generic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| CLASE PARA GESTIONAR LAS TRANSACCIONES CON EL SERVIDOR LDAP
|--------------------------------------------------------------------------
|
| En esta clase controlador se definen los métodos para poder gestionar
| las transacciones con el servidor LDAP CORPOELEC (validación de usuarios,
| consultas por cuaquier criterio entre otros)
|
|--------------------------------------------------------------------------
 */

class LDAPController extends Controller
{

    /**
     * FUNCIÓN PARA VALIDADR EL USUARIO EL EL SERVIDOR LDAP CORPOELEC.
     *
     * @param mixed $nombreUsuario
     * @param mixed $contrasena
     * @return string
     *
     */

    public static function validarUsuarioLDAP($nombreUsuario, $contrasena)
    {
        try {

            $server_LDAP = 'ldap://ldapr1-sb.corpoelec.com.ve';
            $domain = "dc=corpoelec,dc=gob,dc=ve";
            $domain_mail = "@corpoelec.gob.ve";
            $servidor_ldap = $server_LDAP; //El servidor controlador de dominio
            $dominio_NB = $domain; //Nombre del dominio
            $connect = ldap_connect($servidor_ldap, 389); //Conexion al Servidor

            if ($connect) //Si todo ok, continua
            {

                ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
                $r = ldap_bind($connect);
                $filter = "(&(objectClass=posixAccount)(uid=" . $nombreUsuario . "))";
                $base_dn = $dominio_NB;
                $search = ldap_search($connect, $base_dn, $filter);
                $info = ldap_get_entries($connect, $search);
                $NombreApellidoUsuario = "";

                $arreglo_usuario = null;

                for ($i = 0; $i < $info["count"]; $i++) {

                    $dn = $info[$i]["dn"];
                    $NombreApellidoUsuario = $info[$i]["cn"][0];
                    $arreglo_usuario['nombre'] = $info[$i]["cn"][0];
                    $arreglo_usuario['uid'] = $info[$i]["uid"][0];
                    $arreglo_usuario['email'] = $info[$i]["mail"][0];
                }

                if ($NombreApellidoUsuario == "") {

                    return self::validarUsuarioLDAP_MPPEE($nombreUsuario, $contrasena);
                    return "ERROR_USER";

                } else {

                    $r = @ldap_bind($connect, $dn, $contrasena);
                    if (!$r) {

                        return "ERROR_PWD";
                    } else {

                        return "OK";
                    }
                }
            } else {
                return ("ERROR_LDAP");
            }
        } catch (\Throwable $th) {

            Log::error('Error al validadar el usuario LDAP - Método:validarUsuarioLDAP - Mensaje: ' . $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            return ("ERROR_LDAP");
        }
    }


    /**
     * FUNCIÓN PARA VALIDADR EL USUARIO EL EL SERVIDOR LDAP MPPEE.
     *
     * @param mixed $nombreUsuario
     * @param mixed $contrasena
     * @return string
     *
     */

    public static function validarUsuarioLDAP_MPPEE($nombreUsuario, $contrasena)
    {
        try {
            $server_LDAP_MPPEE = 'ldap://rubenblades.mppee.gob.ve';
            $domain_mppee = "dc=mppee,dc=gob,dc=ve";
            $domain_mail_mppee = "@mppee.gob.ve";
            $servidor_ldap_mppee = $server_LDAP_MPPEE;    //El servidor controlador de dominio
            $dominio_NB_mppee = $domain_mppee;              //Nombre del dominio
            $connect_mppee = ldap_connect($servidor_ldap_mppee) or die(404);


            if ($connect_mppee) //Si todo ok, continua
            {

                ldap_set_option($connect_mppee, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($connect_mppee, LDAP_OPT_REFERRALS, 0);

                $contrasena   = "Ez47e84THFU99T";
                $dn   = "cn=reader,ou=accounts,ou=Administradores,dc=mppee,dc=gob,dc=ve";
                $r = @ldap_bind($connect_mppee, $dn, $contrasena);

                $filter = "(&(objectclass=posixaccount)(shadowFlag=1)(uid=" . $nombreUsuario . "))";
                $base_dn = $dominio_NB_mppee;
                $search = ldap_search($connect_mppee, $base_dn, $filter);
                $info[] = ldap_get_entries($connect_mppee, $search);


                for ($i = 0; $i < count($info); $i++) {

                    $dn = $info[$i][0]["dn"];
                    $NombreApellidoUsuario = $info[$i][0]["cn"][0];
                    $arreglo_usuario['nombre'] = $info[$i][0]["cn"][0];
                    $arreglo_usuario['uid'] = $info[$i][0]["uid"][0];
                    $arreglo_usuario['email'] = $info[$i][0]["mail"][0];
                }

                if ($NombreApellidoUsuario == "") {
                    return "ERROR_USER";
                }else{
                    $r = @ldap_bind($connect_mppee, $dn, $contrasena);
                    if (!$r) {

                        return "ERROR_PWD";
                    } else {

                        return "OK";
                    }
                }
            }

        } catch (\Throwable $th) {

            Log::error('Error al validadar el usuario LDAP - Método:validarUsuarioLDAP_MPPEE - Mensaje: ' .  $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            return ("ERROR_LDAP");

        }
    }


    /**
     * CONSULTA EL USUARIOS EN EL SERVIDOR LDAP DE CORPOELEC POR SU NÚMERO DE CEDULA
     * @param \Illuminate\Http\Request $request
     *@return void
     */

    public static function consultarUsuarioLDAP(Request $request)
    {
        /* if ($request->ajax()) { */

        $cedula = $request->get('cedula');
        $arreglo_usuario = [];

        $paramentros = array('cedula' => $cedula);

        $rules = [
            'cedula' => ['required'],
        ];

        $messages = [
            'cedula.required' => 'La cédula es obligatoria.',
        ];

        $validator = Validator::make($paramentros, $rules, $messages)->validate();

        try {

            $server_LDAP = 'ldap://ldapr1-sb.corpoelec.com.ve';
            $domain = "dc=corpoelec,dc=gob,dc=ve";
            $servidor_ldap = $server_LDAP; //El servidor controlador de dominio
            $dominio_NB = $domain; //Nombre del dominio
            $connect = ldap_connect($servidor_ldap); //Conexion al Servidor

            if ($connect) //Si todo ok, continua
            {

                ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
                $r = ldap_bind($connect) or die('BAD ATUH');

                $filter = "(&(objectClass=posixAccount)(carlicense=" . $cedula . "))";
                $base_dn = $dominio_NB;
                $search = ldap_search($connect, $base_dn, $filter);
                $info = ldap_get_entries($connect, $search);

                for ($i = 0; $i < $info['count']; $i++) {
                    $arreglo_usuario[$info[$i]["uid"][0]] = $info[$i]["uid"][0];
                }

                if (count($arreglo_usuario) === 0) {
                    echo self::consultarUsuarioLDAP_MPPEE($cedula);
                } else {
                    echo json_encode($arreglo_usuario);
                }
            } else {

                Log::error('Error al conectar con el servidor LDAP');
                echo 500;
            }
        } catch (\Throwable $th) {

            Log::error('Error al consultar el usuario LDAP - Método:consultarUsuarioLDAP - Mensaje: ' .  $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            echo 500;
        }
        /* }else{
            abort(401);
        } */
    }



    /**
     * CONSULTA EL USUARIOS EN EL SERVIDOR LDAP DEL MPPEE POR SU NÚMERO DE CEDULA
     *@param mixed $cedula
     *@return void
     */
    protected function consultarUsuarioLDAP_MPPEE($cedula)
    {
        try {

            $server_LDAP_MPPEE = 'ldap://rubenblades.mppee.gob.ve';
            $domain_mppee = "dc=mppee,dc=gob,dc=ve";
            $domain_mail_mppee = "@mppee.gob.ve";
            $servidor_ldap_mppee = $server_LDAP_MPPEE;    //El servidor controlador de dominio
            $dominio_NB_mppee = $domain_mppee;              //Nombre del dominio
            $connect_mppee = ldap_connect($servidor_ldap_mppee) or die(404);
            $arreglo_usuario = [];

            if ($connect_mppee) {  //Si todo ok, continua
                ldap_set_option($connect_mppee, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($connect_mppee, LDAP_OPT_REFERRALS, 0);


                $contrasena   = "Ez47e84THFU99T";
                $dn   = "cn=reader,ou=accounts,ou=Administradores,dc=mppee,dc=gob,dc=ve";

                $r = @ldap_bind($connect_mppee, $dn, $contrasena);

                $filter = "(&(objectclass=posixaccount)(shadowFlag=1)(pager=" . $cedula . "))";
                $base_dn = $dominio_NB_mppee;
                $search = ldap_search($connect_mppee, $base_dn, $filter);
                $info[] = ldap_get_entries($connect_mppee, $search);



                for ($i = 0; $i < $info[0]['count']; $i++) {
                    $arreglo_usuario[$info[$i][0]["uid"][0]] = $info[$i][0]["uid"][0];
                }


                if (count($arreglo_usuario) > 0) {
                    return json_encode($arreglo_usuario);
                } else {
                    return null;
                }
            }
        } catch (\Throwable $th) {
            Log::error('Error al consultar el usuario LDAP - Método:consultarUsuarioLDAP_MPPEE - Mensaje: ' . $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            return $th;
        }
    }


    /**
     * RETORNA LOS DATOS DEL USUARIO DESDE EL SERVIDOR LDAP DE CORPOELEC POR USUARIO
     * @param \Illuminate\Http\Request $request
     *@return void
     */
    public static function consultarDatosUsuarioLDAP(Request $request)
    {
        /* if($request->ajax()){ */
        $usuario = $request->get('usuario');
        $arreglo_usuario = null;

        $paramentros = array('usuario' => $usuario);

        $rules = [
            'usuario' => ['required'],
        ];

        $messages = [
            'usuario.required' => 'El usuario es obligatoria.',
        ];

        $validator = Validator::make($paramentros, $rules, $messages)->validate();

        try {

            $server_LDAP = 'ldap://ldapr1-sb.corpoelec.com.ve';
            $domain = "dc=corpoelec,dc=gob,dc=ve";
            $servidor_ldap = $server_LDAP; //El servidor controlador de dominio
            $dominio_NB = $domain; //Nombre del dominio
            $connect = ldap_connect($servidor_ldap); //Conexion al Servidor

            if ($connect) //Si todo ok, continua
            {
                ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
                $r = ldap_bind($connect);
                $filter = "(&(objectClass=posixAccount)(uid=" . $usuario . "))";
                $base_dn = $dominio_NB;
                $search = ldap_search($connect, $base_dn, $filter);
                $info = ldap_get_entries($connect, $search);

                if ($info['count'] === 0) {
                    $usuario_mppee = self::consultarDatosUsuarioLDAP_MPPEE($usuario);
                    $arreglo_usuario['email'] = $usuario_mppee[0][0]["mail"][0]; //? Verificar si fue un error temporal con el servidor LDAP del MPPEE
                    $arreglo_usuario['nombre'] = $usuario_mppee[0][0]["givenname"][0];
                    $arreglo_usuario['apellido'] = $usuario_mppee[0][0]["sn"][0];
                } else {
                    $arreglo_usuario['email'] = $info[0]["mail"][0];
                    $arreglo_usuario['nombre'] = $info[0]["givenname"][0];
                    $arreglo_usuario['apellido'] = $info[0]["sn"][0];
                }


                echo json_encode($arreglo_usuario);
            } else {
                echo 500;
            }
        } catch (\Throwable $th) {

            Log::error('Error al consultar el usuario LDAP - Método:consultarUsuarioLDAP - Mensaje: ' .  $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            echo 500;
        }
        /* }else{
    abort(401);
    } */
    }


    /**
     * RETORNA LOS DATOS DEL USUARIO DESDE EL SERVIDOR DEL MPPEE POR USUARIO
     * @param \Illuminate\Http\Request $request
     *@return void
     */

    public static function consultarDatosUsuarioLDAP_MPPEE($usuario)
    {
        try {
            $server_LDAP_MPPEE = 'ldap://rubenblades.mppee.gob.ve';
            $domain_mppee = "dc=mppee,dc=gob,dc=ve";
            $domain_mail_mppee = "@mppee.gob.ve";
            $servidor_ldap_mppee = $server_LDAP_MPPEE;    //El servidor controlador de dominio
            $dominio_NB_mppee = $domain_mppee;              //Nombre del dominio
            $connect_mppee = ldap_connect($servidor_ldap_mppee) or die(404);
            $arreglo_usuario = [];

            if ($connect_mppee) {  //Si todo ok, continua
                ldap_set_option($connect_mppee, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($connect_mppee, LDAP_OPT_REFERRALS, 0);

                $contrasena   = "Ez47e84THFU99T";
                $dn   = "cn=reader,ou=accounts,ou=Administradores,dc=mppee,dc=gob,dc=ve";
                $r = @ldap_bind($connect_mppee, $dn, $contrasena);

                $filter = "(&(objectclass=posixaccount)(shadowFlag=1)(uid=" . $usuario . "))";
                $base_dn = $dominio_NB_mppee;
                $search = ldap_search($connect_mppee, $base_dn, $filter);
                $info[] = ldap_get_entries($connect_mppee, $search);

                return $info;
            }
        } catch (\Throwable $th) {
            Log::error('Error en consultarDatosUsuarioLDAP_MPPEE: ' .  $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            echo 500;
        }
    }


    
    /**
     * Consulta un usario en el servidor LDAP por su número de cédula.
     *
     * @param mixed $cedula
     * @return  \Illuminate\Http\JsonResponse|void
     * @author A7343230 <mortegano@corpoelec.gob.ve>
     */
    public static function consultarDatosUsuarioLDAPXCedula($cedula)
    {

        $arreglo_usuario = array();
        try {

            $server_LDAP = 'ldap://ldapr1-sb.corpoelec.com.ve';
            $domain = "dc=corpoelec,dc=gob,dc=ve";
            $servidor_ldap = $server_LDAP; //* El servidor controlador de dominio
            $dominio_NB = $domain; //* Nombre del dominio
            $connect = ldap_connect($servidor_ldap); //*Conexion al Servidor
            $foto='';

            if ($connect) //* Si todo ok, continua
            {
                ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
                $r = ldap_bind($connect);
                $filter = "(&(objectClass=posixAccount)(carlicense=" . $cedula . "))";
                $base_dn = $dominio_NB;
                $search = ldap_search($connect, $base_dn, $filter);
                $info = ldap_get_entries($connect, $search);


                if ($info['count'] > 0) {

                    for ($i = 0; $i < $info['count']; $i++) {

                        if (array_key_exists('photo',$info[$i])) {
                           $foto=base64_encode($info[$i]["photo"][0]);
                        }

                        array_push($arreglo_usuario,[

                            'email'=> $info[$i]["mail"][0],
                            'nombre'=>strtoupper($info[$i]["givenname"][0]),
                            'apellido'=>strtoupper($info[$i]["sn"][0]),
                            'photo'=> $foto

                        ]);
                    }

                }else{

                    $info=self::consultarDatosUsuarioLDAP_MPPEEXCedula($cedula);
                    //!return $info;
                    if(!is_null($info)){
                        if($info['count']>0){
                            for ($i = 0; $i < $info['count']; $i++) {

                                if (array_key_exists('photo',$info[$i])) {
                                   $foto=base64_encode($info[$i]["photo"][0]);
                                }
        
                                array_push($arreglo_usuario,[
        
                                    'email'=> $info[$i]["mail"][0],
                                    'nombre'=>strtoupper($info[$i]["givenname"][0]),
                                    'apellido'=>strtoupper($info[$i]["sn"][0]),
                                    'photo'=> $foto
        
                                ]);
                            }
                        }
                    }

                }

                return response()->json(['status'=>'ok', 'data'=>$arreglo_usuario],200);
            }
        } catch (\Throwable $th) {

            Log::error('Error al consultar el usuario LDAP - Método:consultarDatosUsuarioLDAPXCedula: ' .  $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            return response()->json(['status'=>'error', 'data'=>[]],500);

        }
    }


    /**
     * Consulta un usario en el servidor LDAP del MPPEE por su número de cédula.
     *
     * @param mixed $cedula
     * @return  \Illuminate\Http\JsonResponse|void
     * @author A7343230 <mortegano@corpoelec.gob.ve>
     */
    public static function consultarDatosUsuarioLDAP_MPPEEXCedula($cedula)
    {
        try {
            $server_LDAP_MPPEE = 'ldap://rubenblades.mppee.gob.ve';
            $domain_mppee = "dc=mppee,dc=gob,dc=ve";
            $domain_mail_mppee = "@mppee.gob.ve";
            $servidor_ldap_mppee = $server_LDAP_MPPEE;    //El servidor controlador de dominio
            $dominio_NB_mppee = $domain_mppee;              //Nombre del dominio
            $connect_mppee = ldap_connect($servidor_ldap_mppee) or die(404);
            $arreglo_usuario = [];

            if ($connect_mppee) {  //Si todo ok, continua
                ldap_set_option($connect_mppee, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($connect_mppee, LDAP_OPT_REFERRALS, 0);


                $contrasena   = "Ez47e84THFU99T";
                $dn   = "cn=reader,ou=accounts,ou=Administradores,dc=mppee,dc=gob,dc=ve";

                $r = @ldap_bind($connect_mppee, $dn, $contrasena);

                $filter = "(&(objectclass=posixaccount)(shadowFlag=1)(pager=" . $cedula . "))";
                $base_dn = $dominio_NB_mppee;
                $search = ldap_search($connect_mppee, $base_dn, $filter);
               
                return ldap_get_entries($connect_mppee, $search);

            }
        } catch (\Throwable $th) {
            Log::error('Error al consultar el usuario LDAP - Método:consultarDatosUsuarioLDAPXCedula: ' .  $th->getMessage() . ' en ' . $th->getFile() . ':' . $th->getLine());
            return null;
        }

    }
}
