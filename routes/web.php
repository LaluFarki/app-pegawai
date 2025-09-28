<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController; //  WAJIB ditambahkan

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/employees', EmployeeController::class);