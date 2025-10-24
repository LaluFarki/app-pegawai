@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Gaji Karyawan</h1>
    <a href="{{ route('salaries.create') }}" class="btn btn-primary mb-3">Input Gaji Baru</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Bulan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salaries as $salary)
                <tr>
                    <td>{{ $loop->iteration + $salaries->firstItem() - 1 }}</td>
                    <td>{{ $salary->employee->nama_lengkap }}</td>
                    <td>{{ $salary->employee->position->nama_jabatan }}</td>
                    <td>{{ $salary->bulan }}</td>
                    <td>Rp {{ number_format($salary->gaji_pokok, 2) }}</td>
                    <td>Rp {{ number_format($salary->tunjangan, 2) }}</td>
                    <td>Rp {{ number_format($salary->potongan, 2) }}</td>
                    <td><strong>Rp {{ number_format($salary->total_gaji, 2) }}</strong></td>
                    <td>
                        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST">
                            <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $salaries->links() !!}
</div>
@endsection