@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Catat Absensi Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
        @csrf          @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                    <select name="karyawan_id" class="form-select" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('karyawan_id') == $emp->id ? 'selected' : '' }}>
                                {{ $emp->nama_lengkap }} ({{ $emp->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status_absensi" class="form-label">Status Absensi</label>
                    <select name="status_absensi" class="form-select" required>
                        <option value="hadir" {{ old('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ old('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ old('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ old('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="waktu_masuk" class="form-label">Waktu Masuk (Contoh: 08:30)</label>
                    <input type="time" name="waktu_masuk" class="form-control" value="{{ old('waktu_masuk') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="waktu_keluar" class="form-label">Waktu Keluar (Contoh: 17:00)</label>
                    <input type="time" name="waktu_keluar" class="form-control" value="{{ old('waktu_keluar') }}">
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection