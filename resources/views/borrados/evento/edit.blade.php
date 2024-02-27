<div>
    {!!Form::open(['url'=>'/evento','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $evento->id_tipo_evento) !!}
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('descripcion', 'evento', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'descripcion',
            $evento->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el evento']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>
