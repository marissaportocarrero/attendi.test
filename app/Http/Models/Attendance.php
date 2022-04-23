<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $fillable = [
        'employee_id', 'date', 'attendance', 'job_input', 'job_output',
        'break_start', 'break_end', 'user_id'
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
