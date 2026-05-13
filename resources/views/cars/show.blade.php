@extends('layouts.app')

@section('title', 'Detail Mobil')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Mobil</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">Nama Mobil</th>
                    <td>{{ $car->nama }}</td>
                </tr>
                <tr>
                    <th>Jenis Mobil</th>
                    <td>{{ $car->jenis }}</td>
                </tr>
                <tr>
                    <th>Harga per Hari</th>
                    <td>Rp {{ number_format($car->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($car->status == 'Tersedia')
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-danger">Disewa</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Gambar</th>
                    <td>
                        @if($car->gambar)
                            <img src="{{ asset('storage/' . $car->gambar) }}" alt="{{ $car->nama }}" width="200" class="img-thumbnail">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Dibuat pada</th>
                    <td>{{ $car->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir diupdate</th>
                    <td>{{ $car->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
