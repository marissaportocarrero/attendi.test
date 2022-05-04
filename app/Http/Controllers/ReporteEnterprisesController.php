<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteEnterprisesController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.reporte.enterprisesfilter');
    }

    public function all()
    {
        $data = DB::table('employees')
            ->join('designations', 'designations.id', '=', 'employees.designation_id')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->join('enterprises', 'enterprises.id', '=', 'employees.enterprise_id')
            ->select(
                'employees.name as empleado',
                'enterprises.name as empresa',
                'departments.name as departamento',
                'designations.name as cargo',
                'employees.start_contract as fecha'
            )->get();
        return response()->json(['reporte' => $data]);
    }
}
