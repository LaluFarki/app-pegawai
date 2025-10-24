<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all(); // 1. Ambil semua data
        return view('departments.index', compact('departments')); // 2. Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create'); // Tampilkan form create
    }

    public function store(Request $request)
    {
        $request->validate([ // Validasi data
            'nama_departemen' => 'required|string|max:100',
        ]);

        Department::create($request->all()); // Simpan data baru

        return redirect()->route('departments.index'); // Kembali ke halaman index
    }

    public function edit(Department $department) // Otomatis cari Dept by ID
    {
        return view('departments.edit', compact('department')); // Kirim data ke form edit
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100',
        ]);

        $department->update($request->all()); // Update data

        return redirect()->route('departments.index');
    }

    public function destroy(Department $department)
    {
        $department->delete(); // Hapus data
        return redirect()->route('departments.index');
    }
}