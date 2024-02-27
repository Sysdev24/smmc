<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controllers_Generic\LDAPController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'usuario';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {

        $this->validateLogin($request);

        $usuario = User::with('Estatus')
            ->where('usuario', strtoupper($request->get('usuario')))
            ->get()
            ->first();
        $credentials = array(
            'usuario' => strtoupper($request->get('usuario')),
            'password' => $request->get('password'),
        );

        if (strtoupper($request->get('usuario')) != 'ADMIN') {

            $usuario_valido = $this->validarUsuarioInterno($credentials, $request);

            if ($usuario_valido === true) {

                $validar_user_LDAP = LDAPController::validarUsuarioLDAP($request->get('usuario'), $request->get('password'));

                if ($validar_user_LDAP == "ERROR_USER") {

                    return back()->withErrors(array('usuario' => 'Usuario LDAP inválido'))->withInput(request(['usuario']));

                } elseif ($validar_user_LDAP == "ERROR_PWD") {

                    return back()->withErrors(array('password' => 'Clave LDAP inválida'))->withInput(request(['usuario']));

                } elseif ($validar_user_LDAP == "ERROR_LDAP") {

                    return back()->withErrors(array('ldap' => 'Error al validar el usuario en el servidor LDAP'))->withInput(request(['usuario']));

                } else {
                    if ($this->validate_User_By_Id($usuario->id_usuario)) {

                        return redirect()->route('home');
                    }
                }
            } else {
                return back()->withErrors(array($usuario_valido['campo'] => $usuario_valido['mensaje']))->withInput(request([$usuario_valido['campo']]));
            }

        } else {

            if ($usuario->Estatus->siglas === 'IN') {

                return back()->withErrors(array('usuario' => "Usuario inactivo en el sistema"))->withInput(request(['usuario']));

            } else {

                if ($this->validate_User($credentials)) {

                    return redirect()->route('home');

                } else {

                    return back()->withErrors(array('usuario' => 'Usuario o clave inválida.'))->withInput(request(['usuario']));
                }
            }

        }

    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate(
            [

                $this->username() => 'required|string',
                'password' => 'required|string',

            ],

            [$this->username() . ".required" => "El usuario en obligatorio.",
                "password.required" => "La clave es obligatoria.",
            ]
        );
    }

    /**
     *  Validad el usuario en la base de datos interna.
     *  @param array $credentials
     *  @return true|void|\Illuminate\Http\RedirectResponse
     */
    protected function validarUsuarioInterno(array $credentials)
    {

        $usuario = User::where('usuario', $credentials['usuario'])->get()->first();

        if ($usuario == null) {

            //return back()->withErrors(array('usuario' => "Usuario no registrado en el sistema"))->withInput(request(['usuario']));
            return array(
                'mensaje' => "Usuario no registrado en el sistema",
                'campo' => "usuario",
            );
        } elseif ($usuario->Estatus->siglas === 'IN') {

            //return back()->withErrors(array('usuario' => "Usuario inactivo en el sistema"))->withInput(request(['usuario']));
            return array(
                'mensaje' => "Usuario inactivo en el sistema",
                'campo' => "usuario",
            );
        } else {
            return true;
        }

    }

    protected function validate_User($credentials)
    {

        if (Auth::attempt($credentials, false)) {
            return true;
        }
    }

    protected function validate_User_By_Id($id)
    {

        if (Auth::loginUsingId($id)) {
            return true;
        }
    }

}
