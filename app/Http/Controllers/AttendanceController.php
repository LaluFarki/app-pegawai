<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    public function index()
    {
        // Ambil data absensi, 'with' employee agar nama karyawan bisa ikut
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * CREATE (Form): Menampilkan form untuk menambah data absen
     */
    public function create()
    {
        // Kita perlu daftar karyawan untuk dropdown
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    /**
     * STORE: Menyimpan data absen baru
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'karyawan_id'    => 'required|exists:employees,id',
            'tanggal'        => 'required|date',
            'waktu_masuk'    => 'nullable|date_format:H:i',
            'waktu_keluar'   => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha', // Sesuaikan dengan ENUM di migrasi Anda
        ]);

        // 2. Simpan
        Attendance::create($request->all());

        // 3. Kembali
        return redirect()->route('attendances.index')
                         ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * EDIT (Form): Menampilkan form untuk mengubah data
     */
    public function edit(Attendance $attendance)
    {
        // Mirip create, kita perlu daftar karyawan
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    /**
     * UPDATE: Menyimpan perubahan data dari form EDIT
     */
    public function update(Request $request, Attendance $attendance)
    {
        // 1. Validasi
        $request->validate([
            'karyawan_id'    => 'required|exists:employees,id',
            'tanggal'        => 'required|date',
            'waktu_masuk'    => 'nullable|date_format:H:i',
            'waktu_keluar'   => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        // 2. Update
        $attendance->update($request->all());

        // 3. Kembali
        return redirect()->route('attendances.index')
                         ->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * DESTROY: Menghapus data
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')
                         ->with('success', 'Data absensi berhasil dihapus.');
    }
}