<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Http\Models\Attendance;
use App\Http\Models\Enterprise;
use App\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReporteController extends Controller
{

    public function reportegeneral()
    {
        return view('admin.reporte.general')
            ->with('data', []);
    }

    public function resgeneral(Request $request)
    {
        $finicio = $_GET['finicio'] ?? null;
        $ffinal = $_GET['ffinal'] ?? null;
        if ($ffinal && $finicio) {
            $data = DB::table('attendances')
                ->join('employees', 'employees.id', '=', 'attendances.employee_id')
                ->join('enterprises', 'enterprises.id', '=', 'employees.enterprise_id')
                ->select(
                    'employees.name as employees',
                    'enterprises.name as enterprises',
                    'attendances.date as date',
                    'attendances.job_input as job_input',
                    'attendances.job_output as job_output',
                    'attendances.attendance as attendance'
                )
                ->where('attendances.date', '>=', $_GET['finicio'])->where('attendances.date', '<=', $_GET['ffinal'])
                ->get();
        } else {
            $data = DB::table('attendances')
                ->join('employees', 'employees.id', '=', 'attendances.employee_id')
                ->join('enterprises', 'enterprises.id', '=', 'employees.enterprise_id')
                ->select(
                    'employees.name as employees',
                    'enterprises.name as enterprises',
                    'attendances.date as date',
                    'attendances.job_input as job_input',
                    'attendances.job_output as job_output',
                    'attendances.attendance as attendance'
                )->get();
        }

        return response()->json([
            'data' => $data,
            'finicio' => $finicio, 'ffinal' => $ffinal
        ]);
    }

    public function pdfresgeneral()
    {

        $finicio = $_GET['finicio'] ?? null;
        $ffinal = $_GET['ffinal'] ?? null;
        if ($ffinal && $finicio) {
            $data = DB::table('attendances')
                ->join('employees', 'employees.id', '=', 'attendances.employee_id')
                ->join('enterprises', 'enterprises.id', '=', 'employees.enterprise_id')
                ->select(
                    'employees.name as employees',
                    'enterprises.name as enterprises',
                    'attendances.date as date',
                    'attendances.job_input as job_input',
                    'attendances.job_output as job_output',
                    'attendances.attendance as attendance'
                )
                ->where('attendances.date', '>=', $_GET['finicio'])->where('attendances.date', '<=', $_GET['ffinal'])
                ->get();
        } else {
            $data = DB::table('attendances')
                ->join('employees', 'employees.id', '=', 'attendances.employee_id')
                ->join('enterprises', 'enterprises.id', '=', 'employees.enterprise_id')
                ->select(
                    'employees.name as employees',
                    'enterprises.name as enterprises',
                    'attendances.date as date',
                    'attendances.job_input as job_input',
                    'attendances.job_output as job_output',
                    'attendances.attendance as attendance'
                )->get();
        }

        $pdf = PDF::loadView('admin.pdf.reportegeneral', ['asistencias' => $data, 'asist' => $_GET['asist'] ?? null, 'emp' => $_GET['emp']]);
        // ->setOptions(['isJavascriptEnabled ' => true, 'isPhpEnabled ' => true, 'isHtml5ParserEnabled ' => true]);
        return $pdf
            ->stream('reportegeneral.pdf');
    }

    public function pdfsub()
    {
        $finicio = $_GET['finicio'] ?? null;
        $ffinal = $_GET['ffinal'] ?? null;
        if ($ffinal && $finicio) {
            $data = DB::table('attendances')
                ->join('employees', 'employees.id', '=', 'attendances.employee_id')
                ->join('enterprises', 'enterprises.id', '=', 'employees.enterprise_id')
                ->select(
                    'employees.name as employees',
                    'enterprises.name as enterprises',
                    'attendances.date as date',
                    'attendances.job_input as job_input',
                    'attendances.job_output as job_output',
                    'attendances.attendance as attendance'
                )
                ->where('attendances.date', '>=', $_GET['finicio'])->where('attendances.date', '<=', $_GET['ffinal'])
                ->get();
        } else {
            $data = DB::table('attendances')
                ->join('employees', 'employees.id', '=', 'attendances.employee_id')
                ->join('enterprises', 'enterprises.id', '=', 'employees.enterprise_id')
                ->select(
                    'employees.name as employees',
                    'enterprises.name as enterprises',
                    'attendances.date as date',
                    'attendances.job_input as job_input',
                    'attendances.job_output as job_output',
                    'attendances.attendance as attendance'
                )->get();
        }

        $pdf = PDF::loadView('admin.pdf.reporteAE', ['asistencias' => $data, 'asist' => $_GET['asist'] ?? null, 'emp' => $_GET['emp'] ?? null]);
        // ->setOptions(['isJavascriptEnabled ' => true, 'isPhpEnabled ' => true, 'isHtml5ParserEnabled ' => true]);
        return $pdf
            ->download('reportegeneral.pdf');
    }

    public function getEmpresa()
    {
        $data = Enterprise::all();

        return response()->json(['empresa' => $data]);
    }

    public function xlsresgeneral()
    {
        $finicio = $_GET['finicio'];
        $ffinal = $_GET['ffinal'];
        $asist = $_GET['asist'];
        $emp = $_GET['emp'];
        return Excel::download(new AttendanceExport($finicio, $ffinal, $asist, $emp), 'reporte_general.xlsx');
    }
}
