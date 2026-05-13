@extends('layouts.app')

@section('title', 'Tambah Mobil - DriveNow')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-custom">
            <div class="card-header-custom">
                <h4 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i> Form Tambah Mobil</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Mobil <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control form-control-custom @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Contoh: Toyota Avanza" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jenis" class="form-label fw-bold">Jenis Mobil <span class="text-danger">*</span></label>
                            <select name="jenis" id="jenis" class="form-select form-control-custom @error('jenis') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="MPV" {{ old('jenis') == 'MPV' ? 'selected' : '' }}>MPV (Keluarga)</option>
                                <option value="SUV" {{ old('jenis') == 'SUV' ? 'selected' : '' }}>SUV (Offroad)</option>
                                <option value="City Car" {{ old('jenis') == 'City Car' ? 'selected' : '' }}>City Car (Perkotaan)</option>
                                <option value="Sedan" {{ old('jenis') == 'Sedan' ? 'selected' : '' }}>Sedan (Mewah)</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label fw-bold">Harga per Hari <span class="text-danger">*</span></label>
                            <input type="number" name="harga" id="harga" class="form-control form-control-custom @error('harga') is-invalid @enderror" value="{{ old('harga') }}" placeholder="350000" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select form-control-custom @error('status') is-invalid @enderror" required>
                                <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Disewa" {{ old('status') == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gambar" class="form-label fw-bold">Gambar Mobil</label>
                            <input type="file" name="gambar" id="gambar" class="form-control form-control-custom @error('gambar') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-save me-2"></i> Simpan
                        </button>
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary px-4">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
