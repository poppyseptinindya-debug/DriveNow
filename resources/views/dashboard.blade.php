@extends('layouts.app')

@section('title', 'DriveNow | Dashboard')
@section('active-dashboard', 'class="active"')

@section('content')
<div class="hero">
    <h2>Selamat Datang di DriveNow</h2>
    <p>Sewa mobil favorit Anda dengan harga terbaik dan pelayanan terpercaya</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Mobil</h3>
        <div class="number">{{ $totalMobil }}</div>
    </div>
    <div class="stat-card">
        <h3>Mobil Tersedia</h3>
        <div class="number">{{ $mobilTersedia }}</div>
    </div>
    <div class="stat-card">
        <h3>Mobil Disewa</h3>
        <div class="number">{{ $mobilDisewa }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Penyewaan</h3>
        <div class="number">{{ $totalPenyewaan }}</div>
    </div>
</div>

<div class="section-title">
    <h2>🔥 Mobil Populer</h2>
</div>
<div class="gallery">
    @foreach($mobilPopuler as $mobil)
    <div class="mobil-card">
        <img src="{{ asset($mobil->gambar ?? 'images/car-default.jpg') }}" alt="{{ $mobil->nama }}">
        <div class="card-body">
            <h4>{{ $mobil->nama }}</h4>
            <p class="jenis">{{ $mobil->jenis }}</p>
            <p class="harga">Rp {{ number_format($mobil->harga, 0, ',', '.') }}/hari</p>
            <span class="status-badge status-{{ strtolower($mobil->status) }}">{{ $mobil->status }}</span>
        </div>
    </div>
    @endforeach
</div>

<div class="section-title" style="margin-top: 40px;">
    <h2>⭐ Riwayat Penilaian Penyewaan</h2>
</div>
<div class="testimoni-grid" id="testimoniContainer"></div>
@endsection
