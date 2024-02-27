<div>
    {!!Form::open(['url'=>'/personal','method'=>'post','id'=>'agregar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'add'])!!}
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('ci', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'ci',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese el numero de cedula']) !!}
        </div>
    </div>
  <hr />
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('nombre', 'NOMBRE:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'nombre',
            null,
            ['class'=>'form-control',
            'placeholder'=>'Ingrese el nombre']) !!}
        </div>

        <div class="col-6">
            {!! Form::label('apellido', 'APELLIDO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'apellido',
            null,
            ['class'=>'form-control', 
            'placeholder'=>'Ingrese el apellido']) !!}
        </div>

        <div class="col-6">
             {!! Form::label('nro_empleado', 'Nro. Empleado:', ['class'=>'form-label font-weight-bold']) !!}
             <small class="text-danger font-italic">Obligatorio</small>
             {!! Form::text(
                 'nro_empleado',
                 null,
                 ['class'=>'form-control',
                 'placeholder'=>'Ingresa el numero de empleado']) !!}
        </div>

    </div>

  <hr />

        <div class="col-6">
                   
            {!! Form::label('cargo', 'Cargo:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('cargo', $cargo, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione el Cargo',]) !!}
        
        </div>
   
        <div class="col-6">
            {!! Form::label('gerencia', 'Gerencia:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('gerencia', $gerencia, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione la gerencia',]) !!}
        </div>

    
    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
        <input type="button" id="btnLimpiaFormulario" value="LIMPIAR" class="btn btn-primary m-2">
    </div>


    <div id="foot-notificacion">


    </div>
    {!! Form::close() !!}
</div>
