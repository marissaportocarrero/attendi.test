<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'dni', 'cellphone', 'gender', 'birth',
        'civil_status', 'file_path', 'photo', 'telephone', 'address', 'email', 'status',
        'emergency_contact', 'emergency_contact_rel', 'emergency_contact_cel',
        'emergency_contact_tel', 'start_contract', 'enterprise_id', 'department_id',
        'designation_id', 'attendance_check', 'input_hour', 'output_hour'
    ];
    public function enterprise()
    {
        return $this->hasOne(Enterprise::class, 'id', 'enterprise_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }
}
