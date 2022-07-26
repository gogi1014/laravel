<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Exports\EmployeeExport;

use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Session;



class EmployeeController extends Controller
{
 
    public function getEmployees(Request $request)
    {
        $employees = new Employee();
        $search = $request->input('search');
        $input =array("search" => $search,"pagg" => 2);
        
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
        Employee::store($request);
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
        (new Employee)->upd($request);
        return redirect('')->with('success', 'Your form has been updated.');
    }
    public function createPDF(Request $request)
    {
        $employees = new Employee();
        $search = $request->input('search');
        $input = array("search" => $search,"pagg" => 2);
        $pdf = PDF::loadView('pdfview',['employees' => $employees->getEmp($input)]);
        return $pdf->download('pdf_file.pdf');
    }
    public function createExcel()
    {
        return Excel::download(new EmployeeExport(), 'users.xlsx');
    }
    public function getBlogs(Request $request)
    {
        $employee = Employee::get();
        return response()->json($employee);
    }  
    
}
