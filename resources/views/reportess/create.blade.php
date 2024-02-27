@extends('layouts.app')

@section('content')
    <div class="container">

       <div class="breadcrumbs">
            <h2 class="mb-3 ml-3 font-weight-bold">
                <a href="{{ route('reportess') }}">
                    <span class="icofont-home"></span>
                </a> REPORTE TENDENCIA</h2>
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
                            <div class="card mt-3">

                                <div class="card-header">
                                    FILTRAR POR:
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                            <div class="col-6">
                                                {!! Form::label('regiones', 'REGIONES', ['class' => 'form-label font-weight-bold']) !!}
                                                <div class="input-group">
                                                    {!! Form::select('regiones', $regiones, null, ['class' => 'form-control reset', 'multiple']) !!}
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                {!! Form::label('estados', 'ESTADOS', ['class' => 'form-label font-weight-bold']) !!}
                                                <div class="input-group">
                                                    {!! Form::select('estados', $estado, null, ['class' => 'form-control reset', 'multiple']) !!}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">


                                        <div class="col-6">
                                            {!! Form::label('informacion', 'REDES SOCIALES', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('informacion', $informacion, null, [
                                                    'class' => 'form-control reset',
                                                    'multiple',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            {!! Form::label('tipo_evento', 'TIPO MENCION', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('tipo_evento', $tipo_evento, null, [
                                                    'class' => 'form-control reset',
                                                    'multiple',
                                                ]) !!}
                                            </div>
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

            const regiones = $('select#regiones');
            const estados = $('select#estados');
            const informacion = $('select#informacion');
            const tipo_evento = $('select#tipo_evento');
            const consultarRegistro = $('#consultar-registro');
            const columnasReportes = $('.columna-incluir ul');
            const columnasReportesExcluir = $('.columna-excluir ul');
            const tituloReporte = $('#titulo_reporte');
            const registrosXPagina = $('#registro_paginas');
            const limpiar = $('#limpiar');
            const fechaRegistro = $('#fecha_registro');

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

                $(function() {
                     $('#fecha_registro').datetimepicker(opcionesDateTimePicker);
                    //  $('#fecha_entrada_desde').data("DateTimePicker").maxDate(new Date);
                 });

                //  $(function() {
                //      $('#fecha_entrada_hasta').datetimepicker(opcionesDateTimePicker);
                //      $('#fecha_entrada_hasta').data("DateTimePicker").maxDate(new Date);
                //  });

            });


            const limpiarFormConsultaRegistro = () => {

                _columnasIncluir = {
                    ci: 'CI',
                    nombre: 'NOMBRES',
                    apellido: 'APELLIDOS',
                    cargo: 'CARGO',
                    gerencia: 'GERENCIA',
                    estatus: 'ESTATUS',
                    nomenclatura: 'NOMENCLATURA',
                    observacion: 'OBSERVACION',
                    asunto: 'ASUNTO',
                    fecha: 'FECHA',

                };

                _columnasExcluir = {

                     correlativo: 'CORRELATIVO',
                     anno: 'AÑO',
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
                gerencia.val('').trigger('change.select2');
                gerencia.prop('disabled', true);

                hoy = new Date();
                //fechaEntradaDesde.val(`01/01/${hoy.getFullYear()}`);
                //fechaEntradaHasta.val(moment().format('DD/MM/YYYY'));
            };



            const consultaRegistro = () => {
                //alert(123);

                const columnas = [];
                const fltrosConsulta = {};
                const param = {}

                const URL_BASE = window.location.protocol + '//' + window.location.host;

                columnasReportes.find('li').each(function(index) {

                    let alias = '';
                    let columna = $(this).attr('id');

                    if ($(this).find('input[type="text"]').val().trim().length > 0) {
                        alias = $(this).find('input[type="text"]').val().trim();
                    } else {
                        alias = $(this).find('p').text();
                    }

                    columnas.push({
                        columna,
                        alias
                    })
                });

                if (regiones.val().length > 0) fltrosConsulta.regiones = regiones.val();
                if (estados.val().length > 0) fltrosConsulta.estados = estados.val();
                if (informacion.val().length > 0) fltrosConsulta.estatus = informacion.val();
               // if (nomenclatura.val().length > 0) fltrosConsulta.nomenclatura = nomenclatura.val();

                fltrosConsulta.fechaRegistro=fechaRegistro.val();


                console.log("Fecha"+fechaRegistro.val());
                // fltrosConsulta.fechaEntradaDesde=fechaEntradaDesde.val();
                // fltrosConsulta.fechaEntradaHasta=fechaEntradaHasta.val();

                // fltrosConsulta.conSalida=conSalida.prop('checked')?true:false;
                // fltrosConsulta.sinSalida=sinSalida.prop('checked')?true:false;


                param.titulo = tituloReporte.val()|| 'LISTADO DE TENDENCIA' ;
                param.paginado = registrosXPagina.val()
                param.columnas = columnas
                param.filtros = fltrosConsulta
                //console.log(param);
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
                        allowOutsideClick: false
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
