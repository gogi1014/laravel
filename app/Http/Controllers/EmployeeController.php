<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Exports\EmployeeExport;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;






class EmployeeController extends Controller
{
    function getEmployees(Request $request)
    {
        $search = $request->input('search');
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = 2;
        $pagg_one = Employee::where('section', 'LIKE', "%{$search}%");
        $pagg = Employee::where('name', 'LIKE', "%{$search}%")->union($pagg_one)->orderBy('id', 'desc')
            ->limit($limit)->offset(($page - 1) * $limit)->get();
        $employees = Employee::where('name', 'LIKE', "%{$search}%")->union($pagg_one)->orderBy('id', 'desc')
        ->get()->count();
        $total_pages = ceil($employees / $limit);     
        return view('employees', ['employees' => $pagg, 'total_pages' => $total_pages,'search' => $search,
        ]);
    }
    public function insertform()
    {
        return view('addEmployee');
    }
    function addEmployees(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|int|max:255',
            'address' => 'required|string|min:3|max:255',
            'section' => 'required|string|min:3|max:255',
            'salary' => 'required|int|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $data = new Employee();
        $data->name = $request->input('name');
        $data->age = $request->input('age');
        $data->address = $request->input('address');
        $data->section = $request->input('section');
        $data->salary = $request->input('salary');
        $data->save();
        return redirect('add')->with('status', "Insert successfully");
    }
    public function editEmployees($id)
    {
        $data = Employee::find($id);
        return view('editEmployee', ['employees' => $data]);
    }
    public function update(Request $request)
    {
        $data = Employee::find($request->id);
        $data->name = $request->input('name');
        $data->age = $request->input('age');
        $data->address = $request->input('address');
        $data->section = $request->input('section');
        $data->salary = $request->input('salary');
        $data->update();
        return redirect()->back()->with('status', 'Student Updated Successfully');
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
