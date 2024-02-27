<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ mb_strtoupper($titulo) . ' | ' . config('app.name', 'tendencia') }}
    </title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icofont.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">

        <header>
            <h1 class="text-white">SISTEMA DE MEDIOS DE COMUNICACION (SMC)</h1>
        </header>

        <main class="py-4">
            <div class="container-fluit m-2">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card shadow p-3">
                            <div id="msg-wait" class="text-center w-100">
                                <p>
                                    <img src="{{ asset('img/loading.gif') }}" alt="" srcset=""
                                        width="64px">
                                </p>
                                <p>
                                    <strong>Espere un momento...</strong>
                                </p>
                            </div>

                            <div id="result" style="display: none">
                                <div class="card-body">
                                    <h1 id="titulo-reporte" class="text-center">
                                        {{ mb_strtoupper($titulo) }}</h1>
                                </div>
                                <div class="table m-2">
                                    <table id="data-table" class="table table-hover" style="width:100%">

                                        <thead>
                                            @foreach ($columnas as $columna)
                                                @switch($columna->columna)


                                                    @case('registro')
                                                        <th id="{{ $columna->columna }}_cedula" style="text-align: center">
                                                            {{ mb_strtoupper($columna->alias) . ' (CÉDULA)' }}
                                                        </th>
                                                        <th id="{{ $columna->columna }}_nombre" style="text-align: center">
                                                            {{ mb_strtoupper($columna->alias) . ' (NOMBRE Y APELLIDO)' }}
                                                        </th>
                                                        <th id="{{ $columna->columna }}_informacion" style="text-align: center">
                                                            {{ mb_strtoupper($columna->alias) . ' (MEDIOS DE COMUNICACIÓN)' }}
                                                        </th>
                                                    @break

                                                    @default
                                                        <th id="{{ $columna->columna }}" style="text-align: center">
                                                            {{ mb_strtoupper($columna->alias) }}
                                                        </th>
                                                @endswitch
                                            @endforeach
                                        </thead>
                                        <tbody>
                                            @foreach ($registros as $registro)
                                                <tr>
                                                    @foreach ($registro as $valor)
                                                        @if ($valor === true)
                                                            <td>SÍ</td>
                                                        @elseif($valor === false)
                                                            <td>NO</td>
                                                        @else
                                                            @if (DateTime::createFromFormat('Y-m-d H:i:s', $valor) !== false)
                                                                <td>{{ date('d/m/Y h:i a', strtotime($valor)) }}</td>
                                                            @else
                                                                <td>{{ $valor }}</td>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="row justify-content-center">

                                    <a id="export_to_excel" class="btn btn-primary m-1">
                                        <span class="icofont-file-excel"></span> EXPORTAR A EXCEL
                                    </a>
                                    <a id="export_to_ods" class="btn btn-primary m-1">
                                        <span class="icofont-file-file "></span> EXPORTAR A OPEN OFFICE
                                    </a>
                                    <a id="export_to_pdf" class="btn btn-primary m-1">
                                        <span class="icofont-file-pdf"></span> EXPORTAR A PDF
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/librerias/moment.min.js') }}"></script>
    <script src="{{ asset('js/librerias/locale/es.js') }}"></script>
    <script src="{{ asset('js/librerias/datatables.js') }}"></script>
    <script src="{{ asset('js/librerias/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/librerias/plugins-datatables.js') }}"></script>

</body>


<script>
    /**
     * |Rererencia a elementos HTML|
     */

    const table = $('#data-table');
    const msgWait = $('#msg-wait');
    const result = $('#result');
    const exportToExcel = $('#export_to_excel');
    const exportToOds = $('#export_to_ods');
    const exportToPdf = $('#export_to_pdf');
    /* ....................................................... */

    const _countColumns = [];
    const _orderBy = [];
    const paginado = JSON.parse(new URLSearchParams(window.location.search).get('q')).paginado;
    const filtros = JSON.parse(new URLSearchParams(window.location.search).get('q')).filtros;
    const columnas = JSON.parse(new URLSearchParams(window.location.search).get('q')).columnas;
    const titulo = JSON.parse(new URLSearchParams(window.location.search).get('q')).titulo;
    const param = {}
    const URL_BASE = window.location.protocol + '//' + window.location.host;

    param.titulo = titulo || 'LISTADO DE TENDENCIA';
    param.paginado = paginado;
    param.columnas = columnas
    param.filtros = filtros;


    $(document).ready(function() {


        msgWait.hide(200);
        result.show('slow');

        $(document).on('click', '#export_to_excel', function() {
            getOrder();
            param.formato = 'xls';
            param.orderBy = _orderBy;
            window.open(URL_BASE + '/export-excel?q=' + encodeURIComponent(JSON.stringify(param)));
        });

        $(document).on('click', '#export_to_ods', function() {
            getOrder();
            param.orderBy = _orderBy;
            param.formato = 'ods';
            window.open(URL_BASE + '/export-excel?q=' + encodeURIComponent(JSON.stringify(param)));
        });

        $(document).on('click', '#export_to_pdf', function() {
            getOrder();
            param.orderBy = _orderBy;
            window.open(URL_BASE + '/export-pdf?q=' + encodeURIComponent(JSON.stringify(param)));
        });


        /**
         * |Contar celdas del encabezado de la tabla para centrar con la librearía dateTable|
         */
        table.find('thead th').each(function(i) {
            _countColumns.push(i);

            if (i<2) {

                _orderBy.push({
                    columna: $(this).attr('id'),
                    orden: "ASC"
                });

            }
        })
console.log(_orderBy);
        table.DataTable({
            language: {
                url: 'js/librerias/es-ES.json'
            },
            info: false,
            pageLength: parseInt(paginado),
            order: _countColumns.length === 1 ? [
                [0, "asc"]
            ] : [
                [0, "asc"],
                [1, "asc"]
            ],
            paging: true,
            lengthChange: false,
            columnDefs: [{
                targets: _countColumns,
                className: 'dt-body-center'
            }],
        });

    });

    const getOrder = () => {

        _orderBy.length = 2;

        table.find('thead th').each(function(i) {
            if (i>1) {
                if ($(this).hasClass('sorting_desc')) {

                    _orderBy.unshift({
                        columna: $(this).attr('id'),
                        orden: "DESC"
                    });
                }

                if ($(this).hasClass('sorting_asc')) {

                    _orderBy.unshift({
                        columna: $(this).attr('id'),
                        orden: "ASC"
                    });
                }
            }
        })
    }
</script>
