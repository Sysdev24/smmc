<div>
    {!!Form::open([
    'url'=>'/tendencia_ven',
    'method'=>'post','
    id'=>'agregar_registro',
    'class'=>'m-4',
    'data-locked'=>'false',
    'data-crud'=>'add'
    ])!!}


   <div class="col-md-4">
        <label>Fecha Registro *(Obligatorio)</label>
        <div class=" input-group">
        <div class="input-group-addon"></div>
         <input type="date" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>" class="form-control file" value="{{ old('fecha') }}">
        </div>
        </div>

  <hr />

     <div class="row mb-4">
        <div class="col-6">

            {!! Form::label('id_informacion', 'Medios de comunicacion:', ['class' => 'form-label font-weight-bold']) !!}
            <small class="text-danger font-italic">Obligatorio</small>

            {!! Form::select('id_informacion', $informacion, null, [
                'class' => 'chosen-select form-control',
                'data-placeholder' => 'Seleccione el medio de informacion',
            ]) !!}
        </div>


    <div class="col-6">
        {!! Form::label('id_tendencia', 'TENDENCIA:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>

        {!! Form::select('id_tendencia', $tendencia, null, [
            'class' => 'chosen-select form-control',
            'data-placeholder' => 'Seleccione la tendencia',
        ]) !!}
    </div>
  </div>


  <div class="row mb-4">
    <div class="col-6">
        {!! Form::label('tendencia_actual', 'Tendencia actual:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>
        {!! Form::textarea('tendencia_actual', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion']) !!}
    </div>

    <div class="col-6">
        {!! Form::label('posicion', 'Posicion:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>
        {!! Form::textarea('posicion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion']) !!}
    </div>

    <div class="row mb-4">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="8"></textarea>
          </div>

    <div class="col-6">
        {!! Form::label('descripcion_tend', 'Descripcion:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>
        {!! Form::textarea('descripcion_tend', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion' ]) !!}
    </div>
    <div class="col-6">
        {!! Form::label('link', 'Link:', ['class' => 'form-label font-weight-bold']) !!}
        <small class="text-danger font-italic">Obligatorio</small>
        {!! Form::textarea('link', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion']) !!}
    </div>

  </div>
  <div class="row mb-4">

    <div class="col-12">
        {!! Form::label('observacion', 'Observacion:', ['class' => 'form-label font-weight-bold']) !!}

        {!! Form::textarea('observacion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Descripcion']) !!}
    </div>


    <div class="row mb-4 justify-content-center">
        {!! Form::submit("GUARDAR", ['class'=>'btn btn-primary m-2']) !!}
        <input type="button" id="btnLimpiaFormulario" value="LIMPIAR" class="btn btn-primary m-2">
    </div>
  </div>

    <div id="foot-notificacion"></div>
    {!! Form::close() !!}
</div>

