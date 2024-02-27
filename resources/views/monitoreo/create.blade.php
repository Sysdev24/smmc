<div>
{!! Form::open([
    'url' => '/monitoreo',
    'method' => 'post',
    'id' => 'agregar_registro',
    'class' => 'm-4',
    'data-locked' => 'false',
    'data-crud' => 'add',
]) !!}



    <div class="col-md-4">
    <div class=" input-group">
        <div class="input-group-addon"></div>

        {{-- <input type="date" min="2023-01-01" class="form-control file" name="fecha" id="fecha"
            value="{{ old('fecha') }}"  required /> --}}
        {{-- <input type="text" class="form-control" id="datepicker"> --}}

        <input type="date" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>" class="form-control file" value="{{ old('fecha') }}">
    </div>

</div>

<hr />

<div class="row mb-4">
    <div class="col-3">
        {!! Form::label('ci', 'CÉDULA:', ['class'=>'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>
        {!! Form::text(
        'ci' ,
        null,
        ['class'=>'form-control',
        'placeholder'=>'Ingrese el numero de cedula', 'id' =>'ci']) !!}
    </div>

    <div class="col-4">
        {!! Form::label('id_personal', 'ID:', ['class'=>'form-label font-weight-bold']) !!}
        {!! Form::text(
        'id_personal',
        null,
        ['class'=>'form-control']) !!}
    </div>

    <div class="col-4">
        {!! Form::label('nombre', 'Nombres:', ['class'=>'form-label font-weight-bold']) !!}
        {!! Form::text(
        'nombre',
        null,
        ['class'=>'form-control','readonly'=>'readonly']) !!}
    </div>


        <div class="col-4">
        {!! Form::label('apellido', 'Apellidos', ['class'=>'form-label font-weight-bold']) !!}
        {!! Form::text(
        'apellido',
        null,
        ['class'=>'form-control','readonly'=>'readonly']) !!}
    </div>
</div>

<hr />

<div class="row mb-4">

    <div class="col-6">

        {!! Form::label('tipo_informacion', 'Tipo de Medios de comunicacion:', [
            'class' => 'form-label font-weight-bold',
        ]) !!}
        <small class="text-danger font-italic">Obligatorio</small>

        {!! Form::select('tipo_informacion', $tipo_informacion, null, [
            'class' => 'chosen-select form-control',
            'data-placeholder' => 'Seleccione el tipo de informacion',
        ]) !!}

    </div>


    <div class="col-6">

        {!! Form::label('informacion', 'Medios de comunicacion:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>

        {!! Form::select('informacion', $informacion, null, [
            'class' => 'chosen-select form-control',
            'data-placeholder' => 'Seleccione el medio de informacion',
        ]) !!}

    </div>
</div>

<div class="row mb-4">
    <div class="col-6">
        {!! Form::label('descripcion', 'Descripcion:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>
        {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion']) !!}
    </div>
    <div class="col-6">
        {!! Form::label('link', 'link:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>
        {!! Form::textarea('link', null, ['class' => 'form-control', 'placeholder' => 'ingrese el link']) !!}
    </div>
</div>

<hr />

<hr>
<h4>REPORTES</h4>

<div class="row mb-4">
    <div class="col-4">

        {!! Form::label('insumo', 'REPORTA:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>

        {!! Form::select('insumo', array_merge([" "=>""],json_decode(json_encode($insumo),true)), null, [
            'class' => 'chosen-select form-control',
            'id' => 'insumo',
            'data-placeholder' => 'Seleccione el insumo',
        ]) !!}

    </div>

    <div class="col-4">

        {!! Form::label('regiones', 'REGIONES:', ['class' => 'form-label font-weight-bold']) !!}


        {{-- {!! Form::select('regiones', array_merge([" "=>""],json_decode(json_encode($regiones),true)), null, [ --}}
        {!! Form::select('regiones', [" " => ""] +json_decode(json_encode($regiones),true), null, [
            'class' => 'chosen-select form-control',
            'id' => 'regiones',
            'data-placeholder' => 'Seleccione la region',
        ]) !!}

    </div>

    <div class="col-4">

        {!! Form::label('estado', 'ESTADOS:', ['class' => 'form-label font-weight-bold']) !!}


        {!! Form::select('estado', [], null, [
            'class' => 'chosen-select form-control',
            'id' => 'estado',
            'data-placeholder' => 'Seleccione el estado',
            //'disabled'=>'disabled'
        ]) !!}

    </div>


</div>


<div class="row mb-4">
    <div class="col-4">
        {!! Form::label('tendencia', 'TENDENCIA:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>

        {!! Form::select('tendencia', $tendencia, null, [
            'class' => 'chosen-select form-control',
            'data-placeholder' => 'Seleccione la tendencia',
        ]) !!}
    </div>
    <div class="col-6">
        {!! Form::label('tipo_evento', 'TIPO DE MINUTA:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>

        {!! Form::select('tipo_evento', $tipo_evento, null, [
            'class' => 'chosen-select form-control',
            'data-placeholder' => 'Seleccione el tipo de minuta',
        ]) !!}
    </div>
</div>


<div class="row mb-4 justify-content-center">
    {!! Form::submit('GUARDAR', ['class' => 'btn btn-primary m-2']) !!}
    <input type="button" id="btnLimpiaFormulario" value="LIMPIAR" class="btn btn-primary m-2">
</div>


<div id="foot-notificacion"></div>

{!! Form::close() !!}
</div>

{{--
<script>
$(function (){
    var today = new Date();
    $('#datepicker').datepicker({
        startDate:today,
        autoclose:true
    });
});
</script> --}}

{{-- <script>
    $('#sandbox-container input').datepicker({
    format: "dd/mm/yyyy",
    language: "es",
    autoclose: true
});
</script> --}}
