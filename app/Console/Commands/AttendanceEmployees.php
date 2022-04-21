<?php

namespace App\Console\Commands;
use App\Http\Models\Attendance;
use App\Http\Models\Employee;
use Carbon\Carbon;

use Illuminate\Console\Command;

class AttendanceEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:employees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registrar lista de asistencia para el día actual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $employees = Employee::where('status', '<>', '0')->where('attendance_check','<>','0')->get();

        foreach ($employees as $employee) {
            $attendance                 = new Attendance();
            $attendance->employee_id    = $employee->id;
            $attendance->date           = $date;
            $attendance->attendance     = '0';
            $attendance->job_input      = "00:00:00";
            $attendance->job_output     = "00:00:00";
            $attendance->break_start    = "00:00:00";
            $attendance->break_end      = "00:00:00";

            $attendance->save();
        }
    }
}
