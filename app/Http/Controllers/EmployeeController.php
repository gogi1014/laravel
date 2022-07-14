<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Exports\EmployeeExport;

use PDF;
use Maatwebsite\Excel\Facades\Excel;







class EmployeeController extends Controller
{
    function getEmployees(Request $request)
    {
        $search = $request->input('search');
        $input = array("search" => $search, "search1" => $search, "pagg" => 3);
        $employees = new Employee();
        return view('employees', ['employees' => $employees->getEmp($input)]);
    }
    public function insertform()
    {
        return view('addEmployee');
    }
    function addEmployees(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|int|max:255',
            'address' => 'required|string|min:3|max:255',
            'section' => 'required|string|min:3|max:255',
            'salary' => 'required|int|max:255',
        ]);
        $input = array("name" => "name", "age" => "age", "address" => "address", "section" => "section", "salary" => "salary");
        $employees = new Employee();
        $employees->store($employees, $request, $input);
        $employees->save();
        return redirect('')->with('success', 'Your form has been submitted.');
    }
    public function editEmployees($id)
    {
        $data = Employee::find($id);
        return view('editEmployee', ['employees' => $data]);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|int|max:255',
            'address' => 'required|string|min:3|max:255',
            'section' => 'required|string|min:3|max:255',
            'salary' => 'required|int|max:255',
        ]);
        $input = array("name" => "name", "age" => "age", "address" => "address", "section" => "section", "salary" => "salary");
        $employees = Employee::find($request->id);
        $employees->store($employees, $request, $input);
        $employees->update();
        return redirect('')->with('success', 'Your form has been updated.');
    }
    public function createPDF()
    {
        $data = Employee::all();
        view()->share('employees', $data);
        $pdf = PDF::loadView('pdfview', compact("data"));
        return $pdf->download('pdf_file.pdf');
    }
    public function createExcel()
    {
        return Excel::download(new EmployeeExport, 'excel.xlsx');
    }
}
