@extends('adminlte::page')

@section('title', 'AGREGAR INCIDENCIA')

@section('content_header')
<h2>NUEVA INCIDENCIA</h2>
@stop

@section('content')
<head>
    <!-- Otros enlaces -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<form action="/incidencias" method="POST">
    @csrf
    <div class="mb-3">
    <label for="" class="form-label">USUARIO</label>
    <input id="codigoUsu" name="codigoUsu" type="text" class="form-control" tabindex="1" value="{{ Auth::user()->name }}" readonly>
    </div>
    <div class="mb-3">
            <label for="" class="form-label">TIPO INCIDENTE</label>
                <select name="tipoInci" id="tipoInci" class="form-control" tabindex="1">
                    <option value="Confirmación de pago por correo">Confirmación de pago por correo</option>
                    <option value="Problemas con la dirección de entrega">Problemas con la dirección de entrega</option>
                    <option value="Doble facturación">Doble facturación</option>
                    <option value="Problemas con el procesamiento de pago">Problemas con el procesamiento de pago</option>
                    <option value="Fallo de la aplicación">Fallo de la aplicación</option>
                    <option value="Pedido incorrecto">Pedido incorrecto</option>
                    <option value="Pedido dañado">Pedido dañado</option>
                    <option value="Mala atención del driver">Mala atención del driver</option>
                </select>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">DESCRIPCIÓN</label>
        <input id="descInci" name="descInci" type="text" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">FECHA REGISTRO</label>
        <input id="fechRegiInci" name="fechRegiInci" type="date" class="form-control" tabindex="1">
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