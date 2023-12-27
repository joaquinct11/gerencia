@extends('adminlte::page')

@section('title', 'EDITAR INCIDENCIA')

@section('content_header')
<h2>EDITAR INCIDENCIA</h2>
@stop

@section('content')
<head>
    <!-- Otros enlaces -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<form action="/incidencias/{{$incidencia->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">USUARIO</label>
        <input id="codigoUsu" name="codigoUsu" type="text" class="form-control" tabindex="1" value="{{ Auth::user()->name }}" readonly>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">TIPO INCIDENTE</label>
        <select id="tipoInci" name="tipoInci" type="text" class="form-control" value="{{$incidencia->tipoInci}}" >
        <option value="Confirmación de pago por correo" @if($incidencia->tipoInci == 'Confirmación de pago por correo') selected @endif>Confirmación de pago por correo</option>
        <option value="Problemas con la dirección de entrega" @if($incidencia->tipo == 'Problemas con la dirección de entrega') selected @endif>Problemas con la dirección de entrega</option>
        <option value="Doble facturación" @if($incidencia->tipo == 'Doble facturación') selected @endif>Doble facturación</option>
        <option value="Problemas con el procesamiento de pago" @if($incidencia->tipo == 'Problemas con el procesamiento de pago') selected @endif>Problemas con el procesamiento de pago</option>
        <option value="Fallo de la aplicación" @if($incidencia->tipo == 'Fallo de la aplicación') selected @endif>Fallo de la aplicación</option>
        <option value="Pedido incorrecto" @if($incidencia->tipo == 'Pedido incorrecto') selected @endif>Pedido incorrecto</option>
        <option value="Pedido dañado" @if($incidencia->tipo == 'Pedido dañado') selected @endif>Pedido dañado</option>
        <option value="Mala atención del driver" @if($incidencia->tipo == 'Mala atención del driver') selected @endif>Mala atención del driver</option>
    </select>
    </div>
    
    <div class="mb-3">
        <label for="" class="form-label">DESCRIPCIÓN</label>
        <input id="descInci" name="descInci" type="text" class="form-control" value="{{$incidencia->descInci}}" >
    </div>
    <div class="mb-3">
        <label for="" class="form-label">FECHA REGISTRO</label>
        <input id="fechRegiInci" name="fechRegiInci" type="text" class="form-control" value="{{$incidencia->fechRegiInci}}" >
    </div>
    @if(Auth::user()->isAdmin())
    <div class="mb-3">
        <label for="" class="form-label">SOLUCIÓN</label>
        <input id="soluInci" name="soluInci" type="decimal" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">FECHA SOLUCIÓN</label>
        <input id="fechSoluInci" name="fechSoluInci" type="date" class="form-control" tabindex="1">
    </div>
@endif

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
    <script>
    @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ Session::get('error') }}',
        });
    @endif
</script>
@stop