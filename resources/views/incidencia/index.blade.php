@extends('adminlte::page')

@section('title', 'LLAMAEXPRESS')

@section('content_header')
@stop

@section('content')
<br>
<a href="incidencias/create" class="btn btn-success">NUEVO INCIDENCIA</a>
<hr>
<table id="incidencias" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE REGISTRO</th>
            <th scope="col">TIPO</th>
            <th scope="col">DESCRIPCIÓN</th>
            <th scope="col">FECHA REGISTRO</th>
            <th scope="col">SOLUCIÓN</th>
            <th scope="col">FECHA SOLUCIÓN</th>
            <th scope="col">ESTADO</th>
                <th scope="col">OPCIONES</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($incidencias as $incidencia)
        @if(Auth::user()->isAdmin() || ($incidencia->user && $incidencia->user->name === Auth::user()->name))
            <tr>
                <td>{{$incidencia->id}}</td>
                <td>@isset($incidencia->user) {{$incidencia->user->name}} @endisset</td>
                <td>{{$incidencia->tipoInci}}</td>
                <td>{{$incidencia->descInci}}</td>
                <td>{{$incidencia->fechRegiInci}}</td>
                <td>{{$incidencia->soluInci}}</td>
                <td>{{$incidencia->fechSoluInci}}</td>
                <td>{{$incidencia->estaInci}}</td>
                <td>
                    @if(Auth::user()->isAdmin())
                        <form action="{{route ('incidencias.destroy',$incidencia->id)}}" method="POST">
                            <a href="/incidencias/{{$incidencia->id}}/edit" class="btn btn-info">Editar</a>
                            <a href="/incidencias/{{$incidencia->id}}/solucionar" class="btn btn-secondary">Solucionar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    @elseif(Auth::user()->isClient() || Auth::user()->isOperator())
                        <a href="/incidencias/{{$incidencia->id}}/edit" class="btn btn-info">Editar</a>
                    @endif
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#incidencias').DataTable({
            dom: 'Bfrtip',
            buttons: [
                @if(Auth::user()->isAdmin())
                {
                    extend: 'copy',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exporta todas las columnas excepto la última
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                }
                @endif
            ],
            "pageLength": 5 // Mostrar solo 5 registros por página
        });

        // Agregar confirmación antes de eliminar la incidencia
        $('#incidencias').on('click', '.btn-danger', function (e) {
            e.preventDefault();
            var form = this.form;
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Confirmar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@stop