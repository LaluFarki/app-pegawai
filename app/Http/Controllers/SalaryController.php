<?php

namespace App\Http\Controllers;
use App\Models\Salary;
use App\Models\Employee;
// use Illuminate_Http_Request;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * READ (Index): Menampilkan semua data gaji
     */
    public function index()
    {
        $salaries = Salary::with('employee.position')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    /**
     * CREATE (Form): Menampilkan form untuk menambah data gaji
     */
    public function create()
    {
        // Kita perlu daftar karyawan untuk dropdown
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    /**
     * STORE: Menyimpan data gaji baru
     */
    public function store(Request $request)
    {
        // 1. Validasi input dasar
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'       => 'required|string|max:10',
            'tunjangan'   => 'nullable|numeric|min:0',
            'potongan'    => 'nullable|numeric|min:0',
        ]);

        // 2. Ambil Karyawan & Gaji Pokok-nya
        // Kita pakai 'with' agar relasi 'position' ikut terambil
        $employee = Employee::with('position')->findOrFail($request->karyawan_id);
        $gaji_pokok = $employee->position->gaji_pokok; // Ambil Gaji Pokok dari Jabatan (Position)

        // 3. Siapkan data Tunjangan & Potongan
        $tunjangan = $request->tunjangan ?? 0;
        $potongan = $request->potongan ?? 0;

        // 4. Hitung Total Gaji
        $total_gaji = ($gaji_pokok + $tunjangan) - $potongan;

        // 5. Simpan semua data ke database
        Salary::create([
            'karyawan_id' => $request->karyawan_id,
            'bulan'       => $request->bulan,
            'gaji_pokok'  => $gaji_pokok,  // Simpan Gaji Pokok (snapshot)
            'tunjangan'   => $tunjangan,
            'potongan'    => $potongan,
            'total_gaji'  => $total_gaji,  // Simpan Total Gaji (hasil hitung)
        ]);

        return redirect()->route('salaries.index')
                         ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    /**
     * EDIT (Form): Menampilkan form untuk mengubah data
     */
    public function edit(Salary $salary)
    {
        // Mirip create, kita perlu daftar karyawan
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    /**
     * UPDATE: Menyimpan perubahan data dari form EDIT
     */
    public function update(Request $request, Salary $salary)
    {
        // Logikanya SAMA PERSIS dengan 'store'
        // 1. Validasi
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'       => 'required|string|max:10',
            'tunjangan'   => 'nullable|numeric|min:0',
            'potongan'    => 'nullable|numeric|min:0',
        ]);

        // 2. Ambil Gaji Pokok
        $employee = Employee::with('position')->findOrFail($request->karyawan_id);
        $gaji_pokok = $employee->position->gaji_pokok;

        // 3. Siapkan Tunjangan & Potongan
        $tunjangan = $request->tunjangan ?? 0;
        $potongan = $request->potongan ?? 0;

        // 4. Hitung Total Gaji
        $total_gaji = ($gaji_pokok + $tunjangan) - $potongan;

        // 5. Update data di database
        $salary->update([
            'karyawan_id' => $request->karyawan_id,
            'bulan'       => $request->bulan,
            'gaji_pokok'  => $gaji_pokok,
            'tunjangan'   => $tunjangan,
            'potongan'    => $potongan,
            'total_gaji'  => $total_gaji,
        ]);

        return redirect()->route('salaries.index')
                         ->with('success', 'Data gaji berhasil diperbarui.');
    }

    /**
     * DESTROY: Menghapus data
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')
                         ->with('success', 'Data gaji berhasil dihapus.');
    }
}