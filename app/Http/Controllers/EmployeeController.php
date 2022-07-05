<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    function getEmployees()
    {
        $data = DB::table('employee')->get();
        return view('employees', ['employees' => $data]);
    }
    public function insertform()
    {
        return view('addEmployee');
    }
    function addEmployees(Request $request)
    {
        $name = $request->input('name');
        $age = $request->input('age');
        $address = $request->input('address');
        $section = $request->input('section');
        $salary = $request->input('salary');
        $data = array('name' => $name, "address" => $address, "age" => $age, "section" => $section, "salary" => $salary);
        DB::table('employee')->insert($data);
        return redirect('add')->with('status', "Insert successfully");
    }
}
