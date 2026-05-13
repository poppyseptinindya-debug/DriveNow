@extends('layouts.app')

@section('title', 'Edit Mobil')

@section('content')
<div class="container">
    <h1>Edit Mobil</h1>

    <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Mobil</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $car->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <select name="jenis" class="form-control" required>
                <option value="MPV" {{ $car->jenis == 'MPV' ? 'selected' : '' }}>MPV</option>
                <option value="SUV" {{ $car->jenis == 'SUV' ? 'selected' : '' }}>SUV</option>
                <option value="City Car" {{ $car->jenis == 'City Car' ? 'selected' : '' }}>City Car</option>
                <option value="Sedan" {{ $car->jenis == 'Sedan' ? 'selected' : '' }}>Sedan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Harga per Hari</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $car->harga) }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Tersedia" {{ $car->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Disewa" {{ $car->status == 'Disewa' ? 'selected' : '' }}>Disewa</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
            @if($car->gambar)
                <img src="{{ asset('storage/' . $car->gambar) }}" width="100" class="mt-2">
                <small class="text-muted d-block">Gambar saat ini</small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
