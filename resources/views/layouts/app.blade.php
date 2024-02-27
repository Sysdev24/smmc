<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema de Monitoreo de Medios de Comunicacion') }}</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icofont.css') }}" rel="stylesheet">
    <link href="{{ asset('css/zebra_tooltips.css') }}" rel="stylesheet">
    <link href="{{ asset('css/component-chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/waffler.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">

        <header>
            <h1 class="text-white">SISTEMA DE MONITOREO DE MEDIOS DE COMUNICACION (SMMC)</h1>
        </header>

        <div @class([
            'main-container',
            'd-flex' => Auth::check(),
            'justify-content-between' => Auth::check(),
        ])>
            @auth
                <aside>
                    <div class="titulo  text-center">
                        </span>&nbsp;MENÚ PRINCIPAL
                    </div>

                    <div class="menu" style="overflow-y: auto">
                        <ul class="menu-principal">
                            @include('layouts.menu')
                        </ul>
                    </div>
                </aside>
                <div class="main">
                    <nav class="container-nav d-flex justify-content-end">

                        <b><i class="icofont-user-alt-7"></i></b>&nbsp;
                        {{ Auth::user()->nombre }}&nbsp;{{ Auth::user()->apellido }}
                        &nbsp;
                        <div class="user-tools">

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a href="{{ route('logout') }}" title="Cerrar sesión" class="zebra_tooltips"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="icofont-exit"></span>
                            </a>

                            {{-- <a href="#" title="Cambiar contraseña" class="zebra_tooltips">
                            <span class="icofont-lock"></span>
                        </a> --}}

                        </div>

                    </nav>
                @endauth
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
        <footer></footer>
        <!-- Scripts -->
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/DynamicDOM.js') }}"></script>
        <script src="{{ asset('js/librerias/chosen.jquery.js') }}"></script>
        <script src="{{ asset('js/librerias/popper.min.js') }}"></script>
        <script src="{{ asset('js/librerias/moment.min.js') }}"></script>
        <script src="{{ asset('js/librerias/locale/es.js') }}"></script>
        <script src="{{ asset('js/librerias/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('js/librerias/zebra_tooltips.min.js') }}"></script>
        <script type="module" src="{{ asset('js/CrudController.js') }}"></script>
        <script nomodule src="{{ asset('js/controller-no.module.js') }}"></script>
        <script src="{{ asset('js/librerias/select2.js') }}"></script>
        <script src="{{ asset('js/librerias/ConfigLibrerias.js') }}"></script>
        <script src="{{ asset('js/librerias/datatables.js') }}"></script>
        <script src="{{ asset('js/librerias/sweetalert2.js') }}"></script>
        <script src="{{ asset('js/librerias/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('js/librerias/plugins-datatables.js') }}"></script>
        <script src="{{ asset('js/librerias/jquery.waffler.js') }}"></script>

        <script src="{{ asset('js/librerias/twitter-bootstrap/4.5.2/css/bootstrap.min.css') }}"></script>
        <script src="{{ asset('js/librerias/jquery/3.5.1/jquery.min.js') }}"></script>
        <script src="{{ asset('js/librerias/twitter-bootstrap/4.5.2/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/librerias/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css') }}"></script>
        <script src="{{ asset('js/librerias/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js') }}"></script>




        {{--  <script src="https://cdn.datatables.net/plug-ins/1.13.1/sorting/datetime-moment.js"></script> --}}

        <script language="javascript">
            $(document).ready(function() {

                $('form').keypress(function(e) {
                    if (e == 13) {
                        return false;
                    }
                });

                $('input').keypress(function(e) {
                    if (e.which == 13) {
                        return false;
                    }
                });


                /**
                 * * -------------------------------------------------
                 * # CONFIGURAR EL PLUGING DRAG & DROP SORTABLE HTML LIST WITH JQUERY WAFFLER PLUGIN
                 * ! Fuente:https://www.jqueryscript.net/layout/Drag-Drop-Sortable-Html-List-with-jQuery-Waffler-Plugin.html
                 * * --------------------------------------------------
                 */
                $(document).waffler();

            });
        </script>

        @yield('js')
        @yield('js-custom')
</body>


</html>
