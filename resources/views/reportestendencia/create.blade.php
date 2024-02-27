@extends('layouts.app')

@section('content')
    <div class="container">

       <div class="breadcrumbs">
            <h2 class="mb-3 ml-3 font-weight-bold">
                <a href="{{ route('reportesTendencia') }}">
                    <span class="icofont-home"></span>
                </a> REPORTE TENDENCIA</h2>
            </h2>
        </div>


    <div class="row">
        <div class="col-12">
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Criterios de Búsqueda</h3>
      <div class="card-tools">
        <!-- Collapse Button -->
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      {{-- 1° Buscador --}}
      <div class="busqueda">
        <div class="mx-auto pull-right">
            <div class="">
                <form action="{{ route('fechas_solicitudes') }}" method="GET" class="" role="search">
                <div class="input-group input-daterange" data-date-end-date="0d" >
                    <input type="text" class="form-control" id="fechaInicial" name="fechaInicial" min="23-08-2022" placeholder="Seleccione Fecha Inicial"  value="{{ old('fechaInicial') }}" type="text"/>
                    <input type="text" class="form-control" id="fechaFinal" name="fechaFinal"  min="23-08-2022" placeholder="Seleccione Fecha Final" value="{{ old('fechaFinal') }}" type="text"/>
                </div><br>
        <center><button type="submit" class="btn btn-primary btn-sm"> Filtrar </button>     <a href="{{ url('/reportes_graficos/solicitudes') }}" type="button" class="btn btn-danger btn-sm"><span class="fas fa-sync-alt"></span>  Recargar</a>
                </form>
        </div><br>
</div>
</div>
</div></div>
<!-- /.card-body -->
  {{--   --}}
                                <div class="card">
                                    <div class="card-header"><center><b>Registro de Extranjeros</b></center></div>
                                    <div >
                                        <table style="width: 100%">
                                            <tr>
                                            <td > <center><h6><b> Desde:  {{  date('d-m-Y', strtotime( $f1 ?? '2022-08-23')) }}  -
                                               Hasta: {{  date('d-m-Y', strtotime($f2 ?? '    ')) }}</b></h6></center></td>
                                              </tr>

                                        </table>
