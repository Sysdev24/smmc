<div>
    {!!Form::open(['url'=>'/plan','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $plan->id_plan,) !!}
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('descripcion', 'PLAN:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'descripcion',
            $plan->descripcion,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el nombre del plan']) !!}
        </div>
    </div>
	<div class="row mb-4">
        <div class="col-12">
            {!! Form::label('monto_credito', 'MONTO CREDITO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'monto_credito',
            $plan->monto_credito,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el monto credito']) !!}
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>

    <div id="foot-notificacion">

    </div>
    {!! Form::close() !!}
</div>