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
        $employees = Employee::where('name', 'LIKE', "%{$search}%")->orwhere('section', 'LIKE', "%{$search}%")->paginate(2);
        return view('employees', ['employees' => $employees]);
    }
    public function insertform()
    {
        return view('addEmployee');
    }
    function addEmployees(Request $request)
    {
        $request->validate = [
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|int|max:255',
            'address' => 'required|string|min:3|max:255',
            'section' => 'required|string|min:3|max:255',
            'salary' => 'required|int|max:255',
        ];
        Employee::create($request->all());
        return redirect('')->with('success', 'Your form has been submitted.');
    }
    public function editEmployees($id)
    {
        $data = Employee::find($id);
        return view('editEmployee', ['employees' => $data]);
    }
    public function update(Request $request, $id)
    {
        $request->validate = [
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|int|max:255',
            'address' => 'required|string|min:3|max:255',
            'section' => 'required|string|min:3|max:255',
            'salary' => 'required|int|max:255',
        ];
        Employee::find($id)->update($request->all());
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
