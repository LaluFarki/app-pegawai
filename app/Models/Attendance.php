<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    
    // 1. Tentukan nama tabel jika nama model BEDA JAUH dari nama tabel
    // Model 'Attendance' -> tabel 'attendance' (sudah pas, tapi ini untuk jaga-jaga)
    protected $table = 'attendance';

    /**
     * 2. Kolom yang boleh diisi dari form
     * (Sesuaikan dengan file migrasi 'create_attendance_table' Anda)
     */
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi'
    ];

    /**
     * 3. Buat relasi 'belongsTo' (Absen ini milik siapa)
     */
    public function employee()
    {
        // Data absensi ini 'milik' (belongsTo) satu Employee
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}