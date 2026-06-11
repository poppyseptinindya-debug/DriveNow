@extends('layouts.app')

@section('title', 'DriveNow | Sewa Mobil')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('cars.catalog') }}" class="h-10 w-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Form Penyewaan Mobil</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-0.5">Lengkapi form berikut untuk memesan mobil pilihan Anda.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm">
        <form id="bookingForm" action="{{ route('rentals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Pilih Mobil -->
            <div class="space-y-2">
                <label for="car_id" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Pilih Mobil</label>
                <select name="car_id" id="car_id" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('car_id') border-rose-500 @enderror">
                    <option value="">-- Pilih Mobil --</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" data-price="{{ $car->harga_sewa_per_hari }}" {{ (old('car_id', $selectedCarId) == $car->id) ? 'selected' : '' }}>
                            {{ $car->nama_mobil }} - Rp {{ number_format($car->harga_sewa_per_hari, 0, ',', '.') }}/hari
                        </option>
                    @endforeach
                </select>
                <span id="error-car_id" class="text-rose-500 text-xs hidden mt-1"></span>
                @error('car_id')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Tanggal Sewa -->
                <div class="space-y-2">
                    <label for="tanggal_sewa" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Tanggal Sewa</label>
                    <input type="date" name="tanggal_sewa" id="tanggal_sewa" min="{{ date('Y-m-d') }}" value="{{ old('tanggal_sewa') }}" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('tanggal_sewa') border-rose-500 @enderror">
                    <span id="error-tanggal_sewa" class="text-rose-500 text-xs hidden mt-1"></span>
                    @error('tanggal_sewa')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lama Sewa -->
                <div class="space-y-2">
                    <label for="lama_sewa" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Lama Sewa (Hari)</label>
                    <input type="number" name="lama_sewa" id="lama_sewa" min="1" value="{{ old('lama_sewa') }}" placeholder="Contoh: 3" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('lama_sewa') border-rose-500 @enderror">
                    <span id="error-lama_sewa" class="text-rose-500 text-xs hidden mt-1"></span>
                    @error('lama_sewa')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="space-y-2">
                <label for="metode_pembayaran" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="w-full px-4 py-3 border border-slate-200 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 dark:focus:ring-indigo-500 transition-all text-sm @error('metode_pembayaran') border-rose-500 @enderror">
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash (Bayar di Tempat)</option>
                    <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                </select>
                <span id="error-metode_pembayaran" class="text-rose-500 text-xs hidden mt-1"></span>
                @error('metode_pembayaran')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bukti Transfer (Dinamis) -->
            <div id="buktiTransferContainer" class="hidden space-y-2">
                <label for="bukti_transfer" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Unggah Bukti Transfer</label>
                <div class="border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-xl p-4 text-center hover:bg-slate-50 dark:hover:bg-slate-950/40 transition-all cursor-pointer relative">
                    <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/jpeg,image/png,image/jpg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div id="buktiText" class="space-y-1">
                        <i class="fas fa-cloud-upload-alt text-2xl text-slate-400"></i>
                        <p class="text-sm text-slate-600 dark:text-slate-400 font-medium">Klik untuk mengunggah bukti transfer</p>
                        <p class="text-xs text-slate-400">Format: JPG, JPEG, PNG (Maks. 10MB)</p>
                    </div>
                    <div id="previewContainer" class="hidden flex flex-col items-center gap-2">
                        <img id="buktiPreview" class="max-h-40 rounded-lg shadow-sm border border-slate-200 dark:border-slate-800" src="#" alt="Pratinjau Bukti">
                        <span id="fileNameDisplay" class="text-xs font-semibold text-slate-600 dark:text-slate-400"></span>
                    </div>
                </div>
                <span id="error-bukti_transfer" class="text-rose-500 text-xs hidden mt-1"></span>
                @error('bukti_transfer')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Total Harga Display Box -->
            <div id="totalPriceBox" class="hidden p-5 bg-indigo-50 dark:bg-indigo-950/40 rounded-2xl border border-indigo-100 dark:border-indigo-950/50 flex justify-between items-center transition-all duration-300">
                <span class="text-slate-600 dark:text-slate-300 font-semibold text-sm">Estimasi Total Harga</span>
                <span id="totalPriceVal" class="text-xl font-extrabold text-indigo-600 dark:text-indigo-400">Rp 0</span>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-500 text-white font-semibold rounded-xl transition-all shadow-md shadow-indigo-500/10">
                Sewa Sekarang
            </button>
        </form>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="hidden fixed inset-0 z-50 flex flex-col items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-all duration-300">
    <div class="bg-white dark:bg-slate-950 p-6 rounded-3xl border border-slate-100 dark:border-slate-800 flex flex-col items-center gap-4 shadow-xl max-w-xs text-center animate-fade-in">
        <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin"></div>
        <div>
            <h3 class="font-bold text-slate-800 dark:text-slate-200 text-sm">Sedang Mengajukan Sewa</h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Harap tunggu, berkas bukti transfer dan data Anda sedang diunggah ke server...</p>
        </div>
    </div>
</div>


@endsection
