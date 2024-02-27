<div>
    {!!Form::open(['url'=>'/personal','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $personal->id_personal) !!}
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('ci', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'ci',
            $personal->ci,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa la Cedula']) !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-4">
            {!! Form::label('nro_empleado', 'NÚMERO DE EMPLEADO:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'nro_empleado',
            $personal->nro_empleado,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el Nro Empleado']) !!}
        </div>
    </div>

    <hr />
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('nombre', 'NOMBRE:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'nombre',
            $personal->nombre,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el Nombre']) !!}
        </div>

        <div class="col-6">
            {!! Form::label('apellido', 'APELLIDO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'apellido',
            $personal->apellido,
            ['class'=>'form-control',
            'placeholder'=>'Ingresa el Apellido']) !!}
        </div>



    </div>
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('cargo', 'CARGO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::select(
            'cargo',
            $cargo,
            $personal->id_cargo,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione el Cargo']) !!}
        </div>
    </div>
    <hr />


    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('gerencia', 'GERENCIA:' , ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::select(
            'gerencia',
            $gerencia,
            $personal->id_gerencia,
            ['class'=>'form-control chosen-select',
            'data-placeholder'=>'Seleccione la Gerencia'])
            !!}
        </div>
		
		
    </div>
    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
    </div>


    <div id="foot-notificacion">


    </div>
    {!! Form::close() !!}
</div>
<script>
    $(".chosen-select").chosen({
    no_results_text: 'No hay resultados.',
});
</script>
