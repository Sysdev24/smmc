 <div>
    {!!Form::open(['url'=>'/estado','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $estado->id_estado) !!}
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('descripcion', 'ESTADO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'descripcion',
            $estado->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el nombre del estado']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>
