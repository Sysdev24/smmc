{!!Form::open(['url'=>'/tipo_informacion','method'=>'post','id'=>'editar_estatus','class'=>'m-4','data-locked'=>'false','data-crud'=>'edit_status'])!!}

{!! Form::hidden('id', $tipo_informacion->id_tipo_informacion) !!}
<p class="text-center h4">¿Deseas eliminar el medio de comunicacion {{$tipo_informacion->descripcion}}?</p>
<p class="text-center display-4">
    {!! Form::submit("SÍ", ['class'=>'btn btn-primary btn-lg']) !!}
    <a class="btn btn-secondary btn-lg" data-dismiss="modal">NO</a>
</p>
<div id="foot-notificacion">

</div>
{!! Form::close() !!}
