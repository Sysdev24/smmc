<div>
    {!!Form::open(['url'=>'/redes_sociales','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $redes_sociales->id_redes_sociales) !!}
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('descripcion', 'REDES, ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'descripcion',
            $redes_sociales->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el tipo de red social']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>
