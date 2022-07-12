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
}
