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

    public function getEmp($input = array("search" => "", "search1" => "", "pagg" => 0))
    {
        return Employee::where('name', 'LIKE', "%{$input["search"]}%")->orwhere('section', 'LIKE', "%{$input["search1"]}%")->paginate($input["pagg"]);
    }

    public function store($employees, $request, $input = array("name" => "", "age" => 0, "address" => "", "section" => "", "salary" => 0))
    {
        $employees->name = $request->input($input["name"]);
        $employees->age = $request->input($input["age"]);
        $employees->address = $request->input($input["address"]);
        $employees->section = $request->input($input["section"]);
        $employees->salary = $request->input($input["salary"]);
    }
}
