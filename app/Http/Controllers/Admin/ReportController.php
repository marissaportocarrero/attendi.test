<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Employee;
use App\Http\Models\Enterprise;
use App\Http\Models\Department;
use App\Http\Models\Designation;

use Carbon\Carbon;
use DB;

use App\Http\Controllers\Controller;
use App\Http\Models\Attendance;
use Attribute;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __Construct(){

    }

    public function getHome(){
        return view('admin.reports.employees');
    }

}
