<?php

namespace App\Http\Controllers;

use App\Http\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function create(Request $request)
    {
        $employees = Employee::all();
        return view('employee.create')
            ->with("employees", $employees);
    }

    public function store(Request $request)
    {
        DB::table('employees')->insert([
            'name' => $request->name,
            'dni' => $request->dni,
            'cellphone' => $request->telefono,
            'birth' => $request->fecha,
            'gender' => $request->genero,
            'civil_status' => $request->civilest,
            'address' => $request->direccion,
            'email' => $request->email,
            'status' => $request->estado,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return response()->json(['msg' => 'Empleado Guardado con exitoso']);
    }

    public function show(Employee $employee)
    {
        return response()->json(['employee' => $employee]);
    }

    public function update(Request $request)
    {
        $employee = Employee::find($request->id);
        // Asignar los valores
        $employee->name = $request->name;
        $employee->dni = $request->dni;
        $employee->cellphone = $request->telefono;
        $employee->birth = $request->fecha;
        $employee->gender = $request->genero;
        $employee->civil_status = $request->civilest;
        $employee->address = $request->direccion;
        $employee->email = $request->email;
        $employee->status = $request->estado;

        $employee->save();

        return response()->json(['msg' => "Se edito correctamente"]);
    }

    public function all(Request $request)
    {
        return response()->json(['employees' => Employee::all()]);
    }
}
