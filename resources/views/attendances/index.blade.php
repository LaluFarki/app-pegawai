@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Absensi</h1>
    <a href="{{ route('attendances.create') }}" class="btn btn-primary mb-3">Catat Absensi Baru</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $att)
            <tr>
                <td>{{ $loop->iteration + $attendances->firstItem() - 1 }}</td>
                <td>{{ $att->employee->nama_lengkap }}</td> <td>{{ $att->tanggal }}</td>
                <td>{{ $att->waktu_masuk ?? '-' }}</td>
                <td>{{ $att->waktu_keluar ?? '-' }}</td>
                <td><span class="badge bg-info text-dark">{{ $att->status_absensi }}</span></td>
                <td>
                    <form action="{{ route('attendances.destroy', $att->id) }}" method="POST">
                        <a href="{{ route('attendances.edit', $att->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $attendances->links() !!}
</div>
@endsection