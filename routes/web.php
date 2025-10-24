<?php

use App\Http\Controllers\DepartmentController; //  WAJIB ditambahkan
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController; //  WAJIB ditambahkan
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('departments', DepartmentController::class);
Route::resource('/employees', EmployeeController::class);
Route::resource('positions', PositionController::class);
Route::resource('attendances', AttendanceController::class);
Route::resource('salaries', SalaryController::class);