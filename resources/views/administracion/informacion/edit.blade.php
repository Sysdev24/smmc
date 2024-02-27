<div>
    {!!Form::open(['url'=>'/informacion','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $informacion->id_informacion) !!}
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('descripcion', 'informacion', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'descripcion',
            $informacion->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el medios de comunicacion']) !!}
        </div>
    </div>
    <div class="col-6">
        {!! Form::label('tipo_informacion', 'MEDIOS DE INFORMACION:', ['class'=>'form-label font-weight-bold']) !!}
        {!! Form::select ('tipo_informacion',$tipo_informacion,
        ['class'=>'form-control chosen-select',
        'data-placeholder'=>'Seleccione el tipo de informacion']) !!}
    </div>
</div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>

