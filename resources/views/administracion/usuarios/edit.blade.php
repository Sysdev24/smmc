<div>
    {!!Form::open(['url'=>'/usuarios','method'=>'put','id'=>'editar_registro','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit'])!!}
    {!! Form::hidden('id', $usuario->id_usuario) !!}
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('ci', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'ci',
            $usuario->ci,
            ['class'=>'form-control',
            'readonly'=>'readonly']) !!}
        </div>
        <div class="col-6">
            {!! Form::label('usuario', 'USUARIOS:' , ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'usuario',
            $usuario->usuario,
            ['class'=>'form-control',
            'readonly'=>'readonly']) !!}
        </div>
    </div>
    <hr />
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('nombre', 'NOMBRE:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'nombre',
            $usuario->nombre,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
        <div class="col-6">
            {!! Form::label('apellido', 'APELLIDO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'apellido',
            $usuario->apellido,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            {!! Form::label('email', 'CORREO ELEÉCTRONICO:', ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            {!! Form::text(
            'email',
            $usuario->email,
            ['class'=>'form-control','readonly'=>'readonly']) !!}
        </div>
    </div>
    <hr />

    <div class="row mb-4">
        <div class="col-4">
            {!! Form::label('estatus', 'ESTATUS:', ['class'=>'form-label font-weight-bold']) !!}
            {!! Form::text(
            'estatus',
            $usuario->estatus,
            ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-6">
            {!! Form::label('gernecia', 'GERENCIA:' , ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            
            {!! Form::select("gerencia", $gergral, $usuario->id_gergral, ['class'=>'chosen-select
            form-control','data-placeholder'=>'Seleccione la Gerencia'])
            !!}
        </div>
        <div class="col-6">
            {!! Form::label('roles', 'ROLES:' , ['class'=>'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>
            
            {!! Form::select("roles", $roles, $usuario->id_roles, ['class'=>'chosen-select
            form-control','data-placeholder'=>'Seleccione el rol'])
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
