<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function enterprise(){
        return $this->hasOne(Enterprise::class, 'id', 'enterprise_id');
    }

    public function department(){
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function designation(){
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }
}
