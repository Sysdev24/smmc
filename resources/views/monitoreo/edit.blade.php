<div>
    {!!Form::open(['url'=>'/monitoreo','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $monitoreo->id_monitoreo) !!}
     <div class="row mb-4">
        <div class="col-3">
            {!! Form::label('ci', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'ci',
            $personal[0]->ci,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
        <div class="col-3">
            {!! Form::label('id_personal', 'ID:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'id_personal',
            $personal[0]->id_personal,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
        <div class="col-3">
            {!! Form::label('nombre', 'NOMBRES:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'nombre',
            $personal[0]->nombre,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
        <div class="col-3">
            {!! Form::label('apellido', 'APELLIDOS:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'apellido',
            $personal[0]->apellido,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>

     </div>
    <hr />

    <div class="row mb-4">
        <div class="col-5">
            {!! Form::label('fecha', 'FECHA:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'fecha',
            $monitoreo->fecha,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese la fecha']) !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('tipo_informacion', 'MEDIOS DE INFORMACION:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'tipo_informacion',
            $tipo_informacion,
            $monitoreo->tipo_informacion,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el tipo de informacion']) !!}
        </div>
        <div class="col-6">
            {!! Form::label('informacion', 'MEDIOS DE INFORMACION:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'informacion',
            $informacion,
            $monitoreo->informacion,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el medio de informacion']) !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('descripcion', 'Descripcion:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'descripcion',
            $monitoreo->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese alguna descripcion']) !!}
        </div>

        <div class="col-6">
            {!! Form::label('link', 'link:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'link',
            $monitoreo->link,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese algun link']) !!}
        </div>
    </div>

    <div class="row mb-6">
         <div class="col-12">
            {!! Form::label('insumo', 'reporta:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'insumo',
            $insumo,
            $monitoreo->insumo,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione quien reporta']) !!}
        </div>
    </div>
    <div class="row mb-4">
     <div class="col-12">
            {!! Form::label('regiones', 'regiones:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'regiones',
            $regiones,
            $monitoreo->regiones,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione la region']) !!}
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('estado', 'ESTADOS:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'estado',
            $estado,
            $monitoreo->estado,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el estado']) !!}
        </div>
    </div>
      <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('tendencia', 'Tipo:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'tendencia',
            $tendencia,
            $monitoreo->tendencia,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el tipo de tendencia']) !!}
        </div>
        <div class="col-12">
            {!! Form::label('tipo_evento', 'Tipo de MINUTA:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::select(
            'tipo_evento',
            $tipo_evento,
            $monitoreo->tipo_evento,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el tipo de MINUTA']) !!}
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
