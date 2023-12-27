@extends('adminlte::page')

@section('title', 'EDITAR USUARIO')

@section('content_header')
<h2>EDITAR USUARIO</h2>
@stop

@section('content')
<head>
    <!-- Otros enlaces -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<form action="/usuarios/{{$usuario->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">NOMBRE</label>
        <input id="name" name="name" type="text" class="form-control" value="{{$usuario->name}}" >
    </div>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">APELLIDO PATERNO</label>
        <input id="apePat" name="apePat" type="text" class="form-control" value="{{$usuario->apePat}}" >
    </div>
    <div class="mb-3">
        <label for="" class="form-label">APELLIDO MATERNO</label>
        <input id="apeMat" name="apeMat" type="text" class="form-control" value="{{$usuario->apeMat}}" >
    </div>
    <div class="mb-3">
    <label for="tipo" class="form-label">TIPO</label>
    <select name="tipo" id="tipo" class="form-control">
        <option value="Cliente" @if($usuario->tipo == 'Cliente') selected @endif>Cliente</option>
        <option value="Repartidor" @if($usuario->tipo == 'Repartidor') selected @endif>Repartidor</option>
        <option value="Operador" @if($usuario->tipo == 'Operador') selected @endif>Operador</option>
        <option value="Admin" @if($usuario->tipo == 'Admin') selected @endif>Admin</option>
    </select>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">EMAIL</label>
        <input id="email" name="email" type="email" class="form-control" value="{{$usuario->email}}" >
    </div>
    <div class="mb-3">
        <label for="" class="form-label">CONTRASEÑA</label>
        <input id="password" name="password" type="password" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">CONFIRMAR CONTRASEÑA</label>
        <input id="password1" name="password1" type="password" class="form-control" tabindex="1">
    </div>
    <a href="/usuarios" class="btn btn-secondary" tabindex="5">Cancelar</a>
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