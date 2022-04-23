<?php

namespace App\Exports;

use App\Http\Models\Attendance;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromView, ShouldAutoSize, WithEvents
{

    use Exportable;

    public function __construct($finicio, $ffinal)
    {
        $this->finicio = $finicio;
        $this->ffinal = $ffinal;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $asistencias = Attendance::where('date', '>=', $this->finicio)->where('date', '<=', $this->ffinal)->get();
        return view('admin.excel.index', [
            "asistencias" => $asistencias
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A2:E2')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}
