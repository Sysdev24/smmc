<div>
    {!!Form::open(['url'=>'/tendencia_ven','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $tendencia_ven->id) !!}
      <div class="row mb-4">
        <div class="col-5">
            {!! Form::label('fecha', 'FECHA:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'fecha',
            $tendencia_ven->fecha,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese la fecha']) !!}
        </div>
      </div>
        <div class="col-6">
            {!! Form::label('id_informacion', 'MEDIOS DE INFORMACION:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'id_informacion',
            $informacion,
            $tendencia_ven->informacion,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el medio de informacion']) !!}
        </div>

        <div class="col-6">
            {!! Form::label('id_informacion', 'MEDIOS DE INFORMACION:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'id_informacion',
            $informacion,
            $tendencia_ven->informacion,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el medio de informacion']) !!}
        </div>

        <div class="col-6">
            {!! Form::label('id_tendencia', 'Tipo:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'id_tendencia',
            $tendencia,
            $tendencia_ven->tendencia,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el tipo de tendencia']) !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('tendencia_actual', 'Tendencia actual:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'tendencia_actual',
            $tendencia_ven->tendencia_actual,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese alguna tendencia actual']) !!}
        </div>


        <div class="col-6">
            {!! Form::label('posicion', 'posicion:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'posicion',
            $tendencia_ven->posicion,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese alguna posicion']) !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('descripcion_tend', 'Descripcion:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'descripcion_tend',
            $tendencia_ven->descripcion_tend,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese alguna descripcion']) !!}
        </div>





         <div class="col-6">
            {!! Form::label('link', 'link:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'link',
            $tendencia_ven->link,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese algun link']) !!}
        </div>
        <div class="col-12">
            {!! Form::label('observacion', 'observacion:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'link',
            $tendencia_ven->observacion,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese algun observacion']) !!}
        </div>
    </div>

    <hr />

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>


    <div id="foot-notificacion"></div>
    {!! Form::close() !!}
</div>

<script>
    $(".chosen-select").chosen({
    no_results_text: 'No hay resultados.',
});
</script>



