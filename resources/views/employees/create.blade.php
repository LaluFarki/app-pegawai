@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Karyawan Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Terjadi kesalahan input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control" value="{{ old('nomor_telepon') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="departemen_id" class="form-label">Departemen</label>
                    <select name="departemen_id" class="form-select">
                        <option value="">-- Pilih Departemen --</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('departemen_id') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->nama_departemen }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="jabatan_id" class="form-label">Jabatan</label>
                    <select name="jabatan_id" class="form-select">
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach ($positions as $pos)
                            <option value="{{ $pos->id }}" {{ old('jabatan_id') == $pos->id ? 'selected' : '' }}>
                                {{ $pos->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection