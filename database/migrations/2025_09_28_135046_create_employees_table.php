<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            
            // SAMAKAN DENGAN KODE INI
            $table->string('nama_lengkap');  // Diubah dari 'nama_karyawan'
            $table->string('email')->unique();
            $table->string('nomor_telepon'); // DITAMBAHKAN
            $table->date('tanggal_lahir');   // Diubah dari 'tanggal_masuk'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};