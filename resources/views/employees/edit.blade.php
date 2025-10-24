@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Karyawan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="departemen_id" class="form-label">Departemen</label>
                    <select name="departemen_id" class="form-select">
                        <option value="">-- Pilih Departemen --</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('departemen_id', $employee->departemen_id) == $dept->id ? 'selected' : '' }}>
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
                            <option value="{{ $pos->id }}" {{ old('jabatan_id', $employee->jabatan_id) == $pos->id ? 'selected' : '' }}>
                                {{ $pos->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection