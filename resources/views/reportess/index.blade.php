@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="breadcrumbs">
            <h2 class="mb-3 ml-3 font-weight-bold">
                <a href="{{ route('reportess') }}">
                    <span class="icofont-home"></span>
                </a>
                REPORTES
            </h2>
        </div>

        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 bg-dark text-white text-center p-2">
                                <p class=" font-weight-bold m-0">PARÁMETROS DE LA CONSULTA</p>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-9">
                                {!! Form::label('titulo_reporte', 'TÍTULO DEL REPORTE', ['class' => 'form-label font-weight-bold']) !!}
                                {!! Form::text('titulo_reporte', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-3">
                                {!! Form::label('registro_paginas', 'REGISTROS POR PÁGINA', ['class' => 'form-label font-weight-bold']) !!}
                                {!! Form::text('registro_paginas', '10', ['class' => 'form-control']) !!}
                            </div>

                        </div>


                        <div class="card ">

                            <div class="card-header">
                                COLUMNAS DEL REPORTE
                            </div>

                            <div class="card-body">

                                <div class="row columnas justify-content-around align-items-center">

                                    <div class="col-5 columna-incluir">
                                        <h5 class="text-center">INCLUIR</h5>
                                        <ul class="waffle list-unstyled m-1 border border-dark rounded p-1">

                                            <li id="id_personal" class="row m-0 justify-content-between align-items-center">
                                                {{-- DEBE TRAER EL NUMERO DE PERSONAL, NO LA CEDULA --}}
                                                <p class="col-10">NRO. PERSONAL</p>

                                            </li>
                                            <li id="nombre" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">NOMBRES </p>

                                            </li>

                                            <li id="apellido" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">APELLIDOS </p>

                                            </li>

                                            <li id="tipo_evento" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-10">TIPO DE MENCIÓN</p>

                                            </li>

                                            <li id="informacion" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-10">MEDIOS DE COMUNICACION</p>

                                            </li>

                                            <li id="tipo_informacion" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-10"> REDES SOCIALES</p>

                                            </li>

                                            <li id="estatus"
                                                class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">ESTATUS</p>

                                            </li>


                                    </div>

                                    <div class="col-1 arrow-button text-center">
                                        <span class="icofont-arrow-right arrow-button-excluir "></span>
                                        <span class="icofont-arrow-left arrow-button-incluir "></span>
                                    </div>

                                    <div class="col-5 columna-excluir">

                                        <h5 class="text-center">EXCLUIR</h5>
                                        <ul class="list-unstyled m-1 border border-dark rounded p-1">

                                            <li id="fecha"
                                                class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">FECHA</p>
                                            </li>
                                            <li id="link" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">LINK</p>
                                            </li>

                                            <li id="descripcion"
                                                class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">DESCRIPCION</p>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card mt-3">
                                <div class="card-header">
                                    FILTRAR POR:
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            {!! Form::label('estados', 'ESTADOS', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('estados', $estado, null, ['class' => 'form-control reset', 'multiple']) !!}
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            {!! Form::label('tendencia', 'tendencia', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('tendencia', $tendencia, null, ['class' => 'form-control reset', 'multiple']) !!}
                                            </div>
                                        </div>



                                        <div class="col-4">
                                            {!! Form::label('insumo', 'INSUMO', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('insumo', $insumo, null, ['class' => 'form-control reset', 'multiple']) !!}
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>


                     <div class="row justify-content-center p-2 m-3">
                        <a href="javascript:void(0)" id="consultar-registro" class="btn btn-primary m-1">
                              CONSULTAR
                        </a>
                        <a href="javascript:void(0)" id="limpiar" class="btn btn-primary m-1"> LIMPIAR</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script>
            /**
             * *------------------------------------------------
             * | Referencia a elementos HTML.
             * *------------------------------------------------
             * */

            const estados = $('select#estados');

            const insumo = $('select#insumo');
            const tendencia = $('select#tendencia');
            const consultarRegistro = $('#consultar-registro');
            const columnasReportes = $('.columna-incluir ul');
            const columnasReportesExcluir = $('.columna-excluir ul');
            const tituloReporte = $('#titulo_reporte');
            const registrosXPagina = $('#registro_paginas');
            const limpiar = $('#limpiar');

            $(document).ready(function() {

                /**
                 * *----------------------------------------------------
                 * | Referecia a eventos asociados a sus elementos
                 * *----------------------------------------------------
                 **/

                $(document).on('click', '#consultar-registro', function(e) {
                    consultaRegistro()
                });

                $(document).on('click', '#limpiar', function(e) {
                    limpiarFormConsultaRegistro()
                });

                $(document).on('click', '.columna-incluir ul li p , .columna-excluir ul li p', function(e) {
                    toggleSeleccionarColumnas($(this))
                });


                $(document).on('click', '.arrow-button-incluir', function() {
                    incluirColumna();
                });


                $(document).on('click', '.arrow-button-excluir', function() {
                    excluirColumna();
                });

                /**
                 * *------------------------------------
                 * |Confifuraion de librerías
                 * *------------------------------------
                 * */



                /**
                 * # CONFIGURAR EL PLUGING DATE-TIME-PICKER-BOOSTRAP4
                 * ! Fuente:https://www.jqueryscript.net/time-clock/Date-Time-Picker-Bootstrap-4.html
                 */
                const opcionesDateTimePicker = {
                    ignoreReadonly: true,
                    format: 'DD/MM/YYYY',
                    locale: 'es',
                    useCurrent: true,
                    icons: {
                        time: 'icofont-clock-time',
                        date: 'icofont-calendar',
                        up: 'icofont-circled-up',
                        down: 'icofont-circled-down',
                        previous: 'icofont-arrow-left',
                        next: 'icofont-arrow-right',
                        today: 'icofont-focus',
                        clear: 'icofont-trash',
                        close: 'icofont-close-circled'
                    },

                    widgetPositioning: {
                        horizontal: 'auto',
                        vertical: 'auto'
                    },
                };

                // $(function() {
                //      $('#fecha_entrada_desde').datetimepicker(opcionesDateTimePicker);
                //      $('#fecha_entrada_desde').data("DateTimePicker").maxDate(new Date);
                //  });

                //  $(function() {
                //      $('#fecha_entrada_hasta').datetimepicker(opcionesDateTimePicker);
                //      $('#fecha_entrada_hasta').data("DateTimePicker").maxDate(new Date);
                //  });

            });


            const limpiarFormConsultaRegistro = () => {

                _columnasIncluir = {
                    ID: 'NRO. PERSONAL',
                    nombre: 'NOMBRES',
                    apellido: 'APELLIDOS',
                    tipo_evento: 'TIPO DE MENCION',
                    informacion: 'MEDIOS DE COMUNICACION',
                    estatus: 'ESTATUS',
                    tipo_informacion: 'REDES SOCIALES',


                };

                _columnasExcluir = {
                    fecha: 'FECHA',
                    link: 'LINK',
                    tendencia: 'TENDENCIA',
                    descripcion: 'DESCRIPCION',
                };

                columnasReportes.empty();
                columnasReportesExcluir.empty();


                for (const key in _columnasIncluir) {
                    columnasReportes.append(
                        `<li id="${key}" class="row m-0 justify-content-between align-items-center">
                            <p class="col-5">${_columnasIncluir[key]}</p>
                            <input type="text" class="col-6  form-control">
                            <span class=" col-1 icofont-drag "></span>
                        </li>`
                    );
                }

                for (const key in _columnasExcluir) {
                    columnasReportesExcluir.append(
                        `<li id="${key}"
                            class="row m-0 justify-content-between align-items-center">
                            <p class="col-12">${_columnasExcluir[key]}</p>
                        </li>`
                    );
                }

                //* Para referenciar con la librería waffler
                $(document).ready(function() {
                    $(document).waffler();
                });

                tituloReporte.val('');
                registrosXPagina.val('10');
                estados.val('').trigger('change.select2');
                tendencia.val('').trigger('change.select2');
                tendencia.prop('disabled', true);
                insumo.val('').trigger('change.select2');
                //operadoras.val('').trigger('change.select2');

                hoy = new Date();
                //fechaEntradaDesde.val(`01/01/${hoy.getFullYear()}`);
                //fechaEntradaHasta.val(moment().format('DD/MM/YYYY'));
            };



            const consultaRegistro = () => {

                const columnas = [];
                const fltrosConsulta = {};
                const param = {}

                const URL_BASE = window.location.protocol + '//' + window.location.host;

                columnasReportes.find('li').each(function(index) {

                    let alias = '';
                    let columna = $(this).attr('id');

                    /*if ($(this).find('input[type="text"]').val().trim().length > 0) {
                        alias = $(this).find('input[type="text"]').val().trim();
                    } else {*/
                        alias = $(this).find('p').text();
                   // }

                    columnas.push({
                        columna,
                        alias
                    })
                });

                if (estados.val().length > 0) fltrosConsulta.estados = estados.val();
                if (tendencia.val().length > 0) fltrosConsulta.tendencia = tendencia.val();
                if (insumo.val().length > 0) fltrosConsulta.insumo = insumo.val();
                //if (estatus.val().length > 0) fltrosConsulta.estatus = estatus.val();

                // fltrosConsulta.fechaEntradaDesde=fechaEntradaDesde.val();
                // fltrosConsulta.fechaEntradaHasta=fechaEntradaHasta.val();

                // fltrosConsulta.conSalida=conSalida.prop('checked')?true:false;
                // fltrosConsulta.sinSalida=sinSalida.prop('checked')?true:false;


                param.titulo = tituloReporte.val()|| 'LISTADO DE TENDENCIA' ;
                param.paginado = registrosXPagina.val()
                param.columnas = columnas
                param.filtros = fltrosConsulta
                console.log(param);
                window.open(URL_BASE + '/consultar-registro?q=' + encodeURIComponent(JSON.stringify(param)),'_blank');
            }

            /**
             * *----------------------------------------------------
             * | Permite seleccionar o deseleccionar columnas.
             * *----------------------------------------------------
             */
            const toggleSeleccionarColumnas = (e) => {

                if (!e.parent().hasClass('selected')) {

                    e.parent().addClass('selected');

                } else {
                    e.parent().removeClass('selected');
                }

            }


            /**
             * *-----------------------------
             * | Incluir columna(as)
             * *-----------------------------
             **/
            const incluirColumna = () => {

                if ($('.columna-excluir ul li.selected').length > 0) {

                    $('.columna-excluir ul li.selected').each(function(index) {
                        $('.columna-incluir ul').append(

                            `<li id="${$(this).attr('id')}" class="row m-0 justify-content-between align-items-center">
                                <p class="col-5">${$('p', this).html()}</p>
                                <input type="text" class="col-6  form-control">
                                <span class=" col-1 icofont-drag "></span>
                            </li>`
                        );

                        $(this).remove();
                        $(document).ready(function() {
                            $(document).waffler();
                        });
                    });

                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Selecciona la(s) columna(s) que deseas incluir.',
                        showConfirmButton: true,
                        allowOutsideClick: falseLISTADO
                    })
                }
            }


            /**
             * *-----------------------------
             * | Excluir columna(as)
             * *-----------------------------
             **/
            const excluirColumna = () => {
                if ($('.columna-incluir ul li.selected').length > 0) {

                    $('.columna-incluir ul li.selected').each(function(index) {
                        $('.columna-excluir ul').append(

                            `<li id="${$(this).attr('id')}" class="row m-0 justify-content-between align-items-center">
                                <p class="col-12">${$('p', this).html()}</p>
                            </li>`
                        );
                        $(this).remove();
                    });

                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Selecciona la(s) columna(s) que deseas excluir.',
                        showConfirmButton: true,
                        allowOutsideClick: false
                    })
                }
            }
        </script>
    @endsection
