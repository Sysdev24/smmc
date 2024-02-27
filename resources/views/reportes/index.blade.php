@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="breadcrumbs">
            <FONT COLOR="white">
            <h2 class="mb-3 ml-3 font-weight-bold">
                <a href="{{ route('reportes') }}">
                    <span class="icofont-home"></span>
                </a> / REPORTE DE CORRESPONDENCIA</h2></FONT>
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

                                <div class="row columnas justify-content-between align-items-center">

                                    <div class="col-7 columna-incluir ">
                                        <h5 class="text-center">INCLUIR</h5>
                                        <ul class="waffle list-unstyled m-1 border border-dark rounded p-1">

                                             <li id="ci" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">CI</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="nombre" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">NOMBRES </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="apellido" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">APELLIDOS </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="cargo"
                                                class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">CARGO</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="gerencia" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">GERENCIA </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>


                                            <li id="estatus" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">ESTATUS</p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="nomenclatura" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">NOMENCLATURA </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="observacion" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">OBSERVACION </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="asunto" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">ASUNTO </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>

                                            <li id="fecha" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-5">FECHA </p>
                                                <input type="text" class="col-6  form-control">
                                                <span class=" col-1 icofont-drag "></span>
                                            </li>




                                        </ul>
                                    </div>

                                    <div class="col-1 arrow-button text-center">
                                        <span class="icofont-arrow-right arrow-button-excluir "></span>
                                        <span class="icofont-arrow-left arrow-button-incluir "></span>
                                    </div>

                                    <div class="col-4 columna-excluir">

                                        <h5 class="text-center">EXCLUIR</h5>
                                        <ul class="list-unstyled m-1 border border-dark rounded p-1">



                                            <li id="correlativo" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">CORRELATIVO</p>
                                            </li>
                                            <li id="anno" class="row m-0 justify-content-between align-items-center">
                                                <p class="col-12">AÑO</p>
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
                                        <div class="col-6">
                                            {!! Form::label('gerencia', 'GERENCIA', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('gerencia', $gerencia, null, ['class' => 'form-control reset', 'multiple']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6 mt-3">

                                            {!! Form::label('fecha_registro', 'FECHA REGISTRO:', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::text('fecha_registro', date('d/m/Y', strtotime($fechaRegistro)), [
                                                    'readonly' => 'readonly',
                                                    'class' => 'form-control datetimepicker',
                                                    /* 'placeholder' => 'Seleccione la fecha', */
                                                ]) !!}
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span
                                                            class="icofont-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            {!! Form::label('cargo', 'CARGO', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('cargo', $cargo, null, [
                                                    'class' => 'form-control reset',
                                                    'multiple',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            {!! Form::label('estatus', 'ESTATUS', ['class' => 'form-label font-weight-bold']) !!}
                                            <div class="input-group">
                                                {!! Form::select('estatus', $estatus, null, [
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

            const gerencia = $('select#gerencia');
            const cargo = $('select#cargo');
            const estatus = $('select#estatus');
            const nomenclatura = $('select#nomenclatura');
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

                if (cargo.val().length > 0) fltrosConsulta.cargo = cargo.val();
                if (gerencia.val().length > 0) fltrosConsulta.gerencia = gerencia.val();
                if (estatus.val().length > 0) fltrosConsulta.estatus = estatus.val();
                if (nomenclatura.val().length > 0) fltrosConsulta.nomenclatura = nomenclatura.val();

                fltrosConsulta.fechaRegistro=fechaRegistro.val();


                console.log("Fecha"+fechaRegistro.val());
                // fltrosConsulta.fechaEntradaDesde=fechaEntradaDesde.val();
                // fltrosConsulta.fechaEntradaHasta=fechaEntradaHasta.val();

                // fltrosConsulta.conSalida=conSalida.prop('checked')?true:false;
                // fltrosConsulta.sinSalida=sinSalida.prop('checked')?true:false;


                param.titulo = tituloReporte.val()|| 'LISTADO DE CORRESPONDENCIA' ;
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
