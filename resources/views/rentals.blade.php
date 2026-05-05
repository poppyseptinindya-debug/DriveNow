@extends('layouts.app')

@section('title', 'DriveNow | Penyewaan')
@section('active-rentals', 'class="active"')

@section('content')
<div class="form-container">
    <h2>Form Penyewaan Mobil</h2>

    <form id="formSewa">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" id="namaPenyewa" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" id="emailPenyewa" required>
        </div>
        <div class="form-group">
            <label>No. Telepon</label>
            <input type="tel" id="telpPenyewa" required>
        </div>
        <div class="form-group">
            <label>Pilih Mobil</label>
            <select id="pilihMobil" required>
                <option value="">-- Pilih Mobil --</option>
            </select>
        </div>
        <div class="form-group">
            <label>Lama Sewa (hari)</label>
            <input type="number" id="lamaSewa" min="1" required>
        </div>
        <div id="totalHargaDisplay">Total: Rp 0</div>
        <button type="submit" class="btn-primary">Sewa Sekarang</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    console.log('Halaman Penyewaan loaded');

    let mobilData = JSON.parse(localStorage.getItem('mobil')) || [];
    let selectMobil = document.getElementById('pilihMobil');

    mobilData.forEach(mobil => {
        let option = document.createElement('option');
        option.value = mobil.id;
        option.textContent = `${mobil.nama} - Rp ${mobil.harga.toLocaleString('id-ID')} ${mobil.status === 'Tersedia' ? '(Tersedia)' : '(Tidak Tersedia)'}`;
        if(mobil.status !== 'Tersedia') option.disabled = true;
        selectMobil.appendChild(option);
    });

    document.getElementById('lamaSewa').addEventListener('input', function() {
        let mobilId = document.getElementById('pilihMobil').value;
        let mobil = mobilData.find(m => m.id == mobilId);
        let lama = parseInt(this.value) || 0;
        let total = (mobil?.harga || 0) * lama;
        document.getElementById('totalHargaDisplay').innerText = `Total: Rp ${total.toLocaleString('id-ID')}`;
    });

    document.getElementById('formSewa').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Penyewaan berhasil! Terima kasih.');
        this.reset();
        document.getElementById('totalHargaDisplay').innerText = 'Total: Rp 0';
    });
</script>
@endpush
