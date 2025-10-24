@extends('layouts.app') @section('content')
<div class="container">
    <h1>Daftar Karyawan</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Departemen</th> <th>Jabatan</th>   <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $loop->iteration + $employees->firstItem() - 1 }}</td> <td>{{ $employee->nama_lengkap }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->department->nama_departemen }}</td>
                <td>{{ $employee->position->nama_jabatan }}</td>
                <td>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $employees->links() !!}
</div>
@endsection