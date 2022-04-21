<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    public function department(){
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
