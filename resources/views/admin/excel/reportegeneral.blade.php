<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia - PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />
</head>

<body class="">
    <h2 class="text-center">Lista de Tardanzas</h2>
    <p id="f"></p>
    <table class="table table-striped" id="reportg">
        <thead class="table-dark">
            <tr>
                <th>Empresa</th>
                <th>Empleado</th>
                <th>Fecha</th>
                <th>Hora de Entrada</th>
                <th>Hora de Salida</th>
                <th>Asistencia</th>
                <th>Minutos de tardanza</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $a )
            @php
            $hora = date( 'H' ,strtotime($a->job_input));
            $minuto = date('i', strtotime($a->job_input));
            $segundo = date('s',strtotime($a->job_input));
            @endphp


            {{-- Asistencia --}}
            @if($a->attendance == 0)
            @php
            $asit = "Ausente" ;
            @endphp
            @else
            @if ($hora >= 8 && $minuto > 0 && $segundo > 0)
            @php
            $asit = "Tardanza";
            @endphp
            @else
            @php
            $asit = "Presente";
            @endphp
            @endif
            @endif

            @if(!$asistencia && !$empresa)
            <tr>
                <td>{{ $a->employees }}</td>
                <td> {{ $a->enterprises }} </td>
                <td>{{ $a->date }}</td>
                <td> {{ $a->job_input }} </td>
                <td> {{ $a->job_output }} </td>
                <td>{{ $asit }}</td>
                <td>
                    @if($hora >= 8 and $minuto > 0)
                    {{(8 - $hora).':'.(0- $minuto).':'.(0 - $segundo)}}
                    @endif
                </td>
            </tr>

            @elseif($asistencia == strtolower($asit))
            <tr>
                <td>{{ $a->employees }}</td>
                <td> {{ $a->enterprises }} </td>
                <td>{{ $a->date }}</td>
                <td> {{ $a->job_input }} </td>
                <td> {{ $a->job_output }} </td>
                <td>{{ $asit }}</td>
                <td>
                    @if($hora >= 8 and $minuto > 0)
                    {{(8 - $hora).':'.(0- $minuto).':'.(0 - $segundo)}}
                    @endif
                </td>
            </tr>
            @elseif(strtolower($a->enterprises) == strtolower($empresa))
            <tr>
                <td>{{ $a->employees }}</td>
                <td> {{ $a->enterprises }} </td>
                <td>{{ $a->date }}</td>
                <td> {{ $a->job_input }} </td>
                <td> {{ $a->job_output }} </td>
                <td>{{ $asit }}</td>
                <td>
                    @if($hora >= 8 and $minuto > 0)
                    {{(8 - $hora).':'.(0- $minuto).':'.(0 - $segundo)}}
                    @endif
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

</body>

</html>
