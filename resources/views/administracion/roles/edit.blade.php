<div>
    {!!Form::open(['url'=>'/roles','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $roles->id_roles) !!}
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('descripcion', 'ROLES', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'descripcion',
            $roles->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el rol']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>