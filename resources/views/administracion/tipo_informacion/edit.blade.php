<div>
    {!!Form::open(['url'=>'/tipo_informacion','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $tipo_informacion->id_tipo_informacion) !!}
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('descripcion', 'INFORMACION', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'descripcion',
            $tipo_informacion->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el medio de comunicacion']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>
