<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', [EmployeeController::class, 'getEmployees']);

Route::get('add', [EmployeeController::class, 'insertform']);

Route::post('create', [EmployeeController::class, 'addEmployees']);

Route::get('edit/{id}', [EmployeeController::class, 'editEmployees']);

Route::put('update/{id}', [EmployeeController::class, 'update']);

Route::get('/search/', [EmployeeController::class, 'getEmployees']);

Route::get('pdf', [EmployeeController::class, 'createPDF']);

Route::get('excel', [EmployeeController::class, 'createExcel']);

Route::get('/blog', [EmployeeController::class, 'getBlogs']);

Route::delete('delete/{id}', [EmployeeController::class, 'delete']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
