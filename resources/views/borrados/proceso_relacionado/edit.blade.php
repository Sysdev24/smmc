<div>
    {!!Form::open(['url'=>'/proceso_relacionado','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $proceso_relacionado->id_proceso_relacionado) !!}
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('descripcion', 'PROCESO', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'descripcion',
            $proceso_relacionado->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el tipo de proceso relacionado']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>

