@extends('layouts.app')

@section('title', 'DriveNow | Edit Mobil')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.cars.index') }}" class="h-10 w-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Mobil</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-0.5">Ubah informasi kendaraan yang dipilih.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm">
        <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Mobil -->
            <div class="space-y-2">
                <label for="nama_mobil" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Nama Mobil</label>
                <input type="text" name="nama_mobil" id="nama_mobil" value="{{ old('nama_mobil', $car->nama_mobil) }}" placeholder="Contoh: Toyota Avanza Veloz" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('nama_mobil') border-rose-500 @enderror" required>
                @error('nama_mobil')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Warna & Tahun Produksi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="warna" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Warna Mobil</label>
                    <input type="text" name="warna" id="warna" value="{{ old('warna', $car->warna) }}" placeholder="Contoh: Hitam" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('warna') border-rose-500 @enderror" required>
                    @error('warna')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="tahun" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Tahun Produksi</label>
                    <input type="number" name="tahun" id="tahun" value="{{ old('tahun', $car->tahun) }}" placeholder="Contoh: 2022" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('tahun') border-rose-500 @enderror" required>
                    @error('tahun')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Jenis Mobil -->
                <div class="space-y-2">
                    <label for="jenis_mobil" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Jenis Mobil</label>
                    <select name="jenis_mobil" id="jenis_mobil" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('jenis_mobil') border-rose-500 @enderror" required>
                        <option value="MPV" {{ old('jenis_mobil', $car->jenis_mobil) == 'MPV' ? 'selected' : '' }}>MPV</option>
                        <option value="SUV" {{ old('jenis_mobil', $car->jenis_mobil) == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="City Car" {{ old('jenis_mobil', $car->jenis_mobil) == 'City Car' ? 'selected' : '' }}>City Car</option>
                        <option value="Sedan" {{ old('jenis_mobil', $car->jenis_mobil) == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                    </select>
                    @error('jenis_mobil')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Mobil -->
                <div class="space-y-2">
                    <label for="status" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Status Mobil</label>
                    <select name="status" id="status" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('status') border-rose-500 @enderror" required>
                        <option value="Tersedia" {{ old('status', $car->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Disewa" {{ old('status', $car->status) == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                    </select>
                    @error('status')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Harga Sewa -->
            <div class="space-y-2">
                <label for="harga_sewa_per_hari" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Harga Sewa Per Hari (Rupiah)</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400 dark:text-slate-500 text-sm font-semibold">Rp</span>
                    <input type="number" name="harga_sewa_per_hari" id="harga_sewa_per_hari" value="{{ old('harga_sewa_per_hari', $car->harga_sewa_per_hari) }}" placeholder="Contoh: 350000" class="w-full pl-12 pr-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('harga_sewa_per_hari') border-rose-500 @enderror" required>
                </div>
                @error('harga_sewa_per_hari')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div class="space-y-4">
                <label for="gambar" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Foto Mobil (Opsional)</label>
                
                @if($car->gambar)
                    <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800">
                        <img src="{{ asset('storage/' . $car->gambar) }}" alt="Preview" class="w-24 h-16 object-cover rounded-lg border dark:border-slate-700">
                        <div>
                            <p class="text-xs font-semibold text-slate-700 dark:text-slate-300">Gambar Saat Ini</p>
                            <p class="text-slate-400 dark:text-slate-500 text-[11px] mt-0.5">Akan digantikan apabila Anda mengunggah file baru.</p>
                        </div>
                    </div>
                @endif
                
                <input type="file" name="gambar" id="gambar" accept="image/*" class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 transition-all text-sm @error('gambar') border-rose-500 @enderror">
                <p class="text-slate-400 dark:text-slate-500 text-xs">Format file yang diterima: JPG, JPEG, PNG, WEBP. Maksimal ukuran 10MB.</p>
                @error('gambar')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-500 text-white font-semibold rounded-xl transition-all shadow-md shadow-indigo-500/10">
                Perbarui Data Mobil
            </button>
        </form>
    </div>
</div>
@endsection
