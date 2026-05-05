@extends('layouts.app')

@section('title', 'DriveNow | Kontak')
@section('active-tentang', 'class="active"')

@section('content')
<div class="hero">
    <h2>Kontak Kami</h2>
    <p>Hubungi kami untuk informasi lebih lanjut</p>
</div>

<div class="form-container">
    <h3>Informasi Kontak</h3>
    <p>📧 Email: info@drivenow.com</p>
    <p>📱 Telepon: (021) 1234-5678</p>
    <p>📍 Alamat: Jalan Teknologi No. 123, Jakarta Selatan</p>

    <h3>Kirim Pesan</h3>
    <form id="kontakForm">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" id="namaKontak" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" id="emailKontak" required>
        </div>
        <div class="form-group">
            <label>Pesan</label>
            <textarea id="pesanKontak" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn-primary">Kirim</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    console.log('Halaman Kontak loaded');

    document.getElementById('kontakForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Pesan terkirim! Kami akan menghubungi Anda segera.');
        this.reset();
    });
</script>
@endpush
