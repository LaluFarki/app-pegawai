@extends('layouts.app')

@section('content')
    <h1>Tambah Departemen Baru</h1>

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf <div class="mb-3">
            <label for="nama_departemen" class="form-label">Nama Departemen</label>
            <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection