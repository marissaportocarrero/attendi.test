<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asistencia - Excel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />
</head>

<body class="container">
    <h2 class="text-center">Lista de Tardanzas</h2>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Empleados</th>
                <th>Fecha de marcación</th>
                <th>Hora de entrada</th>
                <th>Hora de salida</th>
                <th>Minutos de tardanza</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia )
            <tr>
                <td> {{ $asistencia->employee->name }} </td>
                <td> {{ $asistencia->date }} </td>
                <td> {{ $asistencia->job_input }} </td>
                <td> {{ $asistencia->job_output }} </td>
                <td>
                    @php
                    $hora = date( 'H' ,strtotime($asistencia->job_input));
                    $minuto = date('i', strtotime($asistencia->job_input));
                    $segundo = date('s',strtotime($asistencia->job_input))
                    @endphp

                    @if($hora >= 8 and $minuto > 0)
                    {{(8 - $hora).':'.(0- $minuto).':'.(0 - $segundo)}}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
