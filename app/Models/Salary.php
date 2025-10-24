<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    
    // 1. Tentukan nama tabel jika beda (tapi 'Salary' -> 'salaries' sudah pas)
    protected $table = 'salaries';

    /**
     * 2. Kolom yang boleh diisi dari form
     * (Sesuaikan dengan file migrasi 'create_salaries_table' Anda)
     */
    protected $fillable = [
        'karyawan_id',
        'bulan',
        'gaji_pokok',  // Kita akan isi ini secara otomatis
        'tunjangan',
        'potongan',
        'total_gaji'   // Kita akan hitung ini secara otomatis
    ];

    /**
     * 3. Buat relasi 'belongsTo' (Gaji ini milik siapa)
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}