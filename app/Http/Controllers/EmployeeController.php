<?php

namespace App\Http\Controllers;
 
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * READ (Index): Menampilkan semua data employees
     */
    public function index()
    {
        // 'with' mengambil relasi (department & position) agar efisien
        // 'latest()->paginate(5)' sama seperti di screenshot Anda
        $employees = Employee::with(['department', 'position'])->latest()->paginate(5);
        
        return view('employees.index', compact('employees'));
    }

    /**
     * CREATE (Form): Menampilkan form untuk menambah data baru
     */
    public function create()
    {
        // Kita perlu mengambil data departments dan positions untuk dropdown
        $departments = Department::all();
        $positions = Position::all();
        
        return view('employees.create', compact('departments', 'positions'));
    }

    /**
     * STORE: Menyimpan data baru dari form CREATE
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employees', // Pastikan email unik
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'departemen_id' => 'required|exists:departments,id', // Pastikan ID-nya ada di tabel departments
            'jabatan_id'    => 'required|exists:positions,id',   // Pastikan ID-nya ada di tabel positions
        ]);

        // 2. Simpan data ke database
        Employee::create($request->all());

        // 3. Kembali ke halaman index
        return redirect()->route('employees.index')
                         ->with('success', 'Karyawan baru berhasil ditambahkan.');
    }

    /**
     * SHOW: (Opsional) Menampilkan detail satu employee
     */
    public function show(Employee $employee)
    {
        // Biasanya tidak dipakai di CRUD sederhana, bisa dilewati
        return view('employees.show', compact('employee'));
    }

    /**
     * EDIT (Form): Menampilkan form untuk mengubah data
     */
    public function edit(Employee $employee)
    {
        // Mirip seperti create(), kita perlu data untuk dropdown
        $departments = Department::all();
        $positions = Position::all();

        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * UPDATE: Menyimpan perubahan data dari form EDIT
     */
    public function update(Request $request, Employee $employee)
    {
        // 1. Validasi data
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees')->ignore($employee->id), // Email harus unik, KECUALI untuk user ini sendiri
            ],
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id'    => 'required|exists:positions,id',
        ]);

        // 2. Update data di database
        $employee->update($request->all());

        // 3. Kembali ke halaman index
        return redirect()->route('employees.index')
                         ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * DESTROY: Menghapus data
     */
    public function destroy(Employee $employee)
    {
        // Hapus data
        $employee->delete();

        // Kembali ke halaman index
        return redirect()->route('employees.index')
                         ->with('success', 'Data karyawan berhasil dihapus.');
    }
}