<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    use HasFactory;
    public $fillable = [
        'name',
        'age',
        'address',
        'section',
        'salary'
    ];

    public function getEmp($input)
    {
        $pagg = 5;
        $search = Employee::orderBy('id');
        if (isset($input['search'])) {
            $search->where('name', 'LIKE', "%".$input["search"]."%")->orwhere('section', 'LIKE', "%".$input["search"]."%");
        }   
        if (isset($input['pagg'])) {
         return $search->paginate($input['pagg']);
        } 
        return $search->paginate($pagg);
    }

    public static function store($request)
    {
        $input = $request->input();
        $employees = new Employee();
        $employees->name = $input["name"];
        $employees->age = $input["age"];
        $employees->address = $input["address"];
        $employees->section = $input["section"];
        $employees->salary = $input["salary"];
        $employees->save();
    }

    public function upd($request)
    {
        $input = $request->input();
        $employees = Employee::find($request->id);
        $employees->name = $input["name"];
        $employees->age = $input["age"];
        $employees->address = $input["address"];
        $employees->section = $input["section"];
        $employees->salary = $input["salary"];
        $employees->update();
    }
}
