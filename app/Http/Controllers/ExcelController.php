<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Models\Attendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //
    public function getAttendaceExcel()
    {
        $finicio = $_GET['inicio'];
        $ffinal = $_GET['final'];
        return Excel::download(new UsersExport($finicio, $ffinal), 'reporte.xlsx');
    }
}
