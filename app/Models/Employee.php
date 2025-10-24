<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // 1. TAMBAHKAN $fillable
    // (Sesuaikan nama kolom jika berbeda)
    protected $fillable = [
       'nama_lengkap',  // <-- Ganti dari 'nama_karyawan'
    'email',
    'nomor_telepon', // <-- TAMBAHKAN INI
    'tanggal_lahir', // <-- Ganti dari 'tanggal_masuk'
    'departemen_id',
    'jabatan_id'
        // Tambahkan kolom lain jika ada
    ];

    // 2. TAMBAHKAN RELASI
    public function department()
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }
}