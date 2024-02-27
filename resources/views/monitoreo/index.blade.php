@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="breadcrumbs">
            <h2 class="mb-3 ml-3 font-weight-bold"><a href="{{ route('monitoreo.index') }}">
                    <span class="icofont-home"></span>
                </a> SUPERVISIÓN DEL PERSONAL DE MONITOREO</h2>
        </div>
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card shadow">

                    {{-- <div class=" text-center text-danger p-2  w-100 update-message" style="height: 64px;">

                </div> --}}

                    <div class="card-body">

                        <div class="d-flex mr-1 mb-2 justify-content-between">
                            <div class="refresh-noticafion" style="height: 32px;">

                            </div>
                            <div class="text-center mb-3 ">
                                <a id="openAddWin" href="#winAgregarRegistro" class="btn btn-primary btn-md d-md-flex px-4 "
                                    type="button" class="btn btn-primary zebra_tooltips" data-toggle="modal"
                                    data-target="#winAgregarRegistro" title="Agregar">
                                    <span class="icofont-ui-add"></span>
                                </a>
                            </div>
                        </div>

                        <div id="tabla_registros" class="tabla_movimientos">
                            @include('monitoreo.listado')
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    {{-- VENTANA PARA AGRAGAR NUEVO --}}
    <div class="modal fade" id="winAgregarRegistro" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg with-xl">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title " id="exampleModalLongTitle">REGISTRAR INFORMACION</h5>
                    <a type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="icofont-close-squared-alt"></span>
                    </a>
                </div>
                <div class="modal-body">
                    @include('monitoreo/create')
                </div>
            </div>
        </div>
    </div>
    {{--
==============================================================================================================
--}}

    {{-- ZONA PARA MODIFICAR NUEVO  --}}
    <div class="modal fade" id="winEditEstatus" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title " id="exampleModalLongTitle">SUSPENDER INFORMACION</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="icofont-close-squared-alt"></span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    {{--
==============================================================================================================
--}}

    {{-- ZONA PARA ESTATUS --}}
    <div class="modal fade" id="winEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg with-xl">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title " id="exampleModalLongTitle">MODIFICAR INFORMACION</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="icofont-close-squared-alt"></span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    {{--
==============================================================================================================
--}}
@endsection

@section('js-custom')

                {{--  Prueba AJAX Tipos de Medios de Comunicacion --}}
<script>
     const $_informaciones = $('select#informacion');
     const $_tipo_informaciones = $('select#tipo_informacion');

     $(document).on('change', 'select#tipo_informacion', function() {

/*   Obter region seleccionada.
  Hecer peticion AJAX para obtener los estado de la informacion selccionada.

  si retorrna un resultado

      Activar select informacion
      Limpiar opciones actuales
      Cargar opciones retornadas

  sino
      Limpiar opciones actuales
      desctivar select informacion */

let tipo_informacion = $_tipo_informaciones.val();
let optionHTML = '<option value=" "></option>'

if (tipo_informacion.length !== 0) {

    $.ajax({
        methos: 'get',
        url: 'informacion-por-tipo_informacion',
        data: {
            tipo_informacion: tipo_informacion
        },
        dataType: 'json',

        success: function(res) {

            if (res.length !== 0) {

                for (const key in res) {
                    optionHTML += (`<option value="${key}">${res[key]}</option>`);
                }

                $_informaciones.html(optionHTML);
                $_informaciones.prop('disabled', false).trigger("chosen:updated");

            } else {
                $_informaciones.html(optionHTML);
                $_informaciones.prop('disabled', true).trigger("chosen:updated");
            }

        },
    });

}



});
</script>


    <script>
        const $_insumo = $('select#insumo');
        const $_regiones = $('select#regiones');
        const $_estados = $('select#estado');

        $(document).ready(function() {
            if ($_insumo.val() === '0') {

                $('select#regiones').prop('disabled', false).trigger("chosen:updated");;

            } else {

                $_regiones.prop('disabled', true).trigger("chosen:updated");;

            }
        })


        $(document).on('change', 'select#insumo', function() {

            if ($_insumo.val() === "0") {
                $('select#regiones').prop('disabled', false).trigger("chosen:updated");

            } else {

                $_regiones.prop('disabled', true).trigger("chosen:updated");
                $_regiones.val('').trigger('chosen:updated');
                $_estados.html('<option value=" "></option>');
                $_estados.prop('disabled', true).trigger("chosen:updated");

            }

        });

        $(document).on('change', 'select#regiones', function() {

            /*   Obter region seleccionada.
              Hecer peticion AJAX para obtener los estado de la region selccionada.

              si retorrna un resultado

                  Activar select estado
                  Limpiar opciones actuales
                  Cargar opciones retornadas

              sino
                  Limpiar opciones actuales
                  desctivar select estado */

            let region = $_regiones.val();
            let optionHTML = '<option value=" "></option>'

            if (region.length !== 0) {

                $.ajax({
                    methos: 'get',
                    url: 'estados-por-region',
                    data: {
                        region: region
                    },
                    dataType: 'json',

                    success: function(res) {

                        if (res.length !== 0) {

                            for (const key in res) {
                                optionHTML += (`<option value="${key}">${res[key]}</option>`);
                            }

                            $_estados.html(optionHTML);
                            $_estados.prop('disabled', false).trigger("chosen:updated");

                        } else {
                            $_estados.html(optionHTML);
                            $_estados.prop('disabled', true).trigger("chosen:updated");
                        }

                    },
                });

            }



        });






        function insumo(id) {

            if (id == "2") {
                $("#regiones").prop("disabled", false);
                $("#estado").prop("disabled", false);

            }

            if (id == "1") {
                $("#regiones").prop("disabled", true);
                $("#estado").prop("disabled", true);

            }
        }

        /**
         * Permite seleccionar si la persona que autoriza el ingreso o es otra persona
         */
        $(document).on('change', 'input[name="insumo"]', function() {
            if ($(this).val() === "regiones") {
                $('#toggle_autoriza').show(200);
                $('#regiones').val('regiones');
                $('#estado').val('estado');
            } else {
                $('#toggle_autoriza').hide(200);

            }
        })




    </script>
@endsection
