<?php

namespace App\Http\Controllers;

use App\Http\Models\Attendance;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function index()
    {
        $asistencias = [];
        return view('admin.pdf.index')
            ->with('asistencias', $asistencias);
    }

    public function store(Request $request)
    {
        $asistencias = Attendance::where('date', '>=', $request->finicio)->where('date', '<=', $request->ffinal)->get();

        return view('admin.pdf.index')
            ->with("asistencias", $asistencias)
            ->with("finicio", $request->finicio)
            ->with("ffinal", $request->ffinal);
    }

    public function getAttendanceTardanza()
    {
        $finicio = $_GET['finicio'];
        $ffinal = $_GET['ffinal'];
        $asistencias = Attendance::where('date', '>=', $finicio)->where('date', '<=', $ffinal)->get();

        $pdf = PDF::loadView('admin.pdf.asistencia', ['asistencias' => $asistencias]);
        return $pdf->download('reporte.pdf');
    }
}
