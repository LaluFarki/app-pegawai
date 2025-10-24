@extends('layouts.app')

@section('content')
    <h1>Tambah Jabatan Baru</h1>

    <form action="{{ route('positions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
        </div>
        <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection