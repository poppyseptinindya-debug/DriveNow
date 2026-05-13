@extends('layouts.app')

@section('title', 'Data Mobil - DriveNow')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold"><i class="fas fa-car me-2"></i> Daftar Mobil</h2>
        <p class="text-muted">Kelola data mobil rental Anda</p>
    </div>

    {{-- TOMBOL TAMBAH HANYA UNTUK ADMIN --}}
    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Tambah Mobil
            </a>
        @endif
    @endauth
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Mobil</th>
                    <th>Jenis</th>
                    <th>Harga/Hari</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $car)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($car->gambar)
                            <img src="{{ asset('storage/' . $car->gambar) }}" width="50" height="50" class="rounded" style="object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-car text-secondary"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $car->nama }}</td>
                    <td><span class="badge bg-secondary">{{ $car->jenis }}</span></td>
                    <td class="fw-bold text-primary">Rp {{ number_format($car->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($car->status == 'Tersedia')
                            <span class="badge-tersedia"><i class="fas fa-check-circle me-1"></i> Tersedia</span>
                        @else
                            <span class="badge-disewa"><i class="fas fa-times-circle me-1"></i> Disewa</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-info btn-sm" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>

                        {{-- TOMBOL EDIT & HAPUS HANYA UNTUK ADMIN --}}
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="fas fa-car fa-3x text-muted mb-3 d-block"></i>
                        <p class="text-muted">Belum ada data mobil</p>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('cars.create') }}" class="btn btn-primary btn-sm">Tambah Mobil Sekarang</a>
                            @endif
                        @endauth
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $cars->links() }}
</div>
@endsection
