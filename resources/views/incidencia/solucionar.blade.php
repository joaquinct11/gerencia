@extends('adminlte::page')

@section('title', 'SOLUCIONAR INCIDENCIA')

@section('content_header')
<h2>SOLUCIONAR INCIDENCIA</h2>
@stop

@section('content')
<form action="/incidencias/{{$incidencia->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">USUARIO</label>
        <input id="codigoUsu" name="codigoUsu" type="text" class="form-control" tabindex="1" value="{{$incidencia->codigoUsu}}" readonly>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">TIPO INCIDENTE</label>
        <input id="tipoInci" name="tipoInci" type="text" class="form-control" value="{{$incidencia->tipoInci}}" readonly>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">DESCRIPCIÓN</label>
        <input id="descInci" name="descInci" type="text" class="form-control" value="{{$incidencia->descInci}}" readonly>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">FECHA REGISTRO</label>
        <input id="fechRegiInci" name="fechRegiInci" type="text" class="form-control" value="{{$incidencia->fechRegiInci}}" readonly>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">SOLUCIÓN</label>
        <input id="soluInci" name="soluInci" type="decimal" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">FECHA SOLUCIÓN</label>
        <input id="fechSoluInci" name="fechSoluInci" type="date" class="form-control" tabindex="1">
    </div>
</div>
    <a href="/incidencias" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop