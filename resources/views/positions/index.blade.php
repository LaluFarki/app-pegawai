@extends('layouts.app')

@section('content')
    <h1>Daftar Jabatan (Positions)</h1>
    <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Tambah Jabatan</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($positions as $position)
                <tr>
                    <td>{{ $position->id }}</td>
                    <td>{{ $position->nama_jabatan }}</td>
                    <td>Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection