@extends('layouts.app')

@section('content')
    <h1>Edit Departemen</h1>

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf @method('PUT') <div class="mb-3">
            <label for="nama_departemen" class="form-label">Nama Departemen</label>
            <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" value="{{ $department->nama_departemen }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection