@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Input Gaji Baru</h1>
    <p>Gaji Pokok dan Total Gaji akan dihitung secara otomatis.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('salaries.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                    <select name="karyawan_id" class="form-select" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('karyawan_id') == $emp->id ? 'selected' : '' }}>
                                {{ $emp->nama_lengkap }} (Jabatan: {{ $emp->position->nama_jabatan }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="bulan" class="form-label">Bulan (Contoh: Oktober 2025)</label>
                    <input type="text" name="bulan" class="form-control" value="{{ old('bulan') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tunjangan" class="form-label">Tunjangan</label>
                    <input type="number" name="tunjangan" class="form-control" value="{{ old('tunjangan', 0) }}" step="0.01">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="potongan" class="form-label">Potongan</label>
                    <input type="number" name="potongan" class="form-control" value="{{ old('potongan', 0) }}" step="0.01">
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Simpan Gaji</button>
            </div>
        </div>
    </form>
</div>
@endsection