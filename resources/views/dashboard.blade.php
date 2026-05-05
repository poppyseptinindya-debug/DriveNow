@extends('layouts.app')

@section('title', 'DriveNow | Dashboard')
@section('active-dashboard', 'class="active"')

@section('content')
<div class="hero">
    <h2>Selamat Datang di DriveNow</h2>
    <p>Sewa mobil favorit Anda dengan harga terbaik dan pelayanan terpercaya</p>
</div>

<div class="stats-grid">
    <x-stat-card judul="Total Mobil" nilai="7" ikon="🚗" />
    <x-stat-card judul="Mobil Tersedia" nilai="5" ikon="✅" />
    <x-stat-card judul="Mobil Disewa" nilai="2" ikon="🔴" />
    <x-stat-card judul="Total Penyewaan" nilai="12" ikon="📝" />
</div>

<div class="section-title">
    <h2>🔥 Mobil Populer</h2>
</div>
<div class="gallery" id="popularMobilContainer">
    @forelse($popularMobil ?? [] as $mobil)
    <div class="mobil-card">
        <img src="{{ asset($mobil['gambar']) }}" alt="{{ $mobil['nama'] }}">
        <h4>{{ $mobil['nama'] }}</h4>
        <p>Rp {{ number_format($mobil['harga'], 0, ',', '.') }}</p>
    </div>
    @empty
    <p>Loading...</p>
    @endforelse
</div>
@endsection

@push('scripts')
<script>
    console.log('Halaman Dashboard loaded');

    function updateStats() {
        let mobil = JSON.parse(localStorage.getItem('mobil')) || [];
        let tersedia = mobil.filter(m => m.status === 'Tersedia').length;
        let disewa = mobil.filter(m => m.status === 'Disewa').length;

        document.querySelectorAll('.stat-card .number').forEach((el, i) => {
            if(i === 0) el.innerText = mobil.length;
            if(i === 1) el.innerText = tersedia;
            if(i === 2) el.innerText = disewa;
        });
    }

    updateStats();
</script>
@endpush
