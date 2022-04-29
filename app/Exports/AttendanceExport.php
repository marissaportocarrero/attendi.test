<?php

namespace App\Exports;

use App\Attendance;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AttendanceExport implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;

    public function __construct($finicio, $ffinal, $asist, $emp)
    {
        $this->finicio = $finicio;
        $this->ffinal = $ffinal;
        $this->asistencia = $asist;
        $this->empresa = $emp;
    }

    public function view(): View
    {
        if ($this->ffinal && $this->finicio) {
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

        if ($this->asistencia && $this->empresa) {
            $urlAE = 'admin.excel.reportegeneralAE';
        } else {
            $urlAE = 'admin.excel.reportegeneral';
        }

        return view($urlAE, [
            'asistencias' => $data,
            'asistencia' => $this->asistencia, 'empresa' => $this->empresa
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A3:G3')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}
