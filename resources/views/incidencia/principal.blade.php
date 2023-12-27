@extends('adminlte::page')

@section('title', 'LLAMAEXPRESS')

@section('content_header')
@stop

@section('content')
@if(Auth::user()->isAdmin()) <!-- Verificar si el usuario actual es un administrador -->
    <h1>DASHBOARD PRINCIPAL</h1>

    <div class="row">
        <div class="col-md-6">
            <div style="width: 100%;">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div style="width: 100%;">
                <canvas id="myPieChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
@else
    <h1>Usted no tiene permiso para ver los gráficos.</h1>
@endif

@stop

@section('css')
<!-- Otros enlaces CSS -->
@endsection

@section('js')
<!-- Otros enlaces JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Supongamos que tienes los datos en la variable incidencias
    const incidencias = {!! json_encode($incidencias) !!};

    // Obtén los tipos de incidencia
    const tiposInci = incidencias.map(incidencia => incidencia.tipoInci);

    // Obtén la cantidad de cada tipo de incidencia
    const countTipos = tiposInci.reduce((acc, tipo) => {
        acc[tipo] = (acc[tipo] || 0) + 1;
        return acc;
    }, {});

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(countTipos),
            datasets: [{
                label: 'Cantidad de incidencias por tipo',
                data: Object.values(countTipos),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx2 = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: Object.keys(countTipos),
            datasets: [{
                label: 'Cantidad de incidencias por tipo',
                data: Object.values(countTipos),
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
