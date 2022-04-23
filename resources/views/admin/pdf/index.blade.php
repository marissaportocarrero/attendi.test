@extends('admin.layouts.master')

@section('content')
@php
$countA =count($asistencias);
@endphp

<div class="container bg-white mt-3 p-5">
    <h1>Asistencia - Reportes por fecha</h1>
    <div class="d-flex justify-content-between w-100 flex-wrap" style="overflow-x: scroll">
        <form action="{{ route('attendance.store') }}" method="POST" class="d-flex align-items-center">
            @csrf
            <div class="form-group d-flex align-items-center">
                <label for="finicio" class="label" style="width: 120px; margin-bottom: 0">Fecha Inicio</label>
                <div>
                    <input type="date" id="finicio" name="finicio" class="ml-10 form-control">
                    @error('finicio')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group d-flex ml-5 align-items-center">
                <label for="ffinal" class="label" style="width: 120px; margin-bottom: 0">Fecha Final</label>
                <div>
                    <input type="date" id="ffinal" name="ffinal" class="ml-10 form-control">
                    @error('ffinal')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group d-flex ml-5 align-items-center">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <div class="">
            @if($countA > 0)
            <div class="form-group d-flex ml-5 align-items-center">
                <a href="{{ route('reporte.tardanza', ['finicio'=> $finicio, 'ffinal'=>$ffinal]) }}"
                    class="btn btn-danger">PDF</a>
                <a href="{{ route('excel.reporte',['inicio'=>$finicio, 'final'=>$ffinal]) }}"
                    class="btn btn-success ml-4">Excel</a>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="container bg-white mt-3 p-5">

    @if($countA > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="">
                <tr>
                    <th>Empleados</th>
                    <th>Fecha</th>
                    <th>Hora de entrada</th>
                    <th>Inicio Refrigerio</th>
                    <th>Fin Refrigerio</th>
                    <th>Hora de salida</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asistencias as $asistencia )
                <tr>
                    <td> {{ $asistencia->employee->name }} </td>
                    <td> {{ $asistencia->date }} </td>
                    <td> {{ $asistencia->job_input }} </td>
                    <td> {{ $asistencia->break_start }} </td>
                    <td> {{ $asistencia->break_end }} </td>
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
    </div>
    @else
    <div class="alert alert-primary text-center" role="alert">
        <p class="m-0">No hay reportes realizadas</p>
    </div>
    @endif
</div>

@endsection
