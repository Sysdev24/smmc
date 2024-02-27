@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="container-form-login py-5">

                <div id="head-login" class="text-center">
                    <h2>INICIAR SESIÓN</h2>
                    <h5>
                        <i>BIENVENID@ AL SISTEMA </br>DE MONITOREO DE MEDIOS DE COMUNICACION</i>
                    </h5>

                    @if ($errors->has('ldap'))
                    <div class="text-danger text-center mt-4">
                        <strong>{{$errors->first() }}</strong>
                    </div>
                    @endif
                </div>


                <div class="card shadow p-3">
                    {!! Form::open(['url'=>route('login'),'method'=>'post',"autocomplete"=>"off"]) !!}

                    <div class="mb-4 mx-3">
                        {!! Form::label('usuario', 'USUARIO',['class'=>'form-label font-weight-bold']) !!}
                        {!! Form::text('usuario', old('usuario'), ['class'=>$errors->has('usuario')?'form-control pl-5
                        is-invalid':'form-control pl-5', 'placeholder'=>'Ingresa tu usuario LDAP']) !!}
                        @error('usuario')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4 mx-3">
                        {!! Form::label('password', 'CONTRASEÑA',['class'=>'form-label font-weight-bold']) !!}
                        {!! Form::password('password', ['class'=>$errors->has('password')?'form-control pl-5
                        is-invalid':'form-control pl-5','placeholder'=>'Ingresa tu clave LDAP']) !!}
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4 mx-3 text-center">
                        {!! Form::submit('INICIAR SESIÓN',['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
