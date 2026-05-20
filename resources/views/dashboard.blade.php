@extends('layouts.app')

@section('title', 'DriveNow | Dashboard')
@section('active-dashboard', 'class="active"')

@section('content')
<div class="hero">
    <h2>Selamat Datang di DriveNow</h2>
    <p>Sewa mobil favorit Anda dengan harga terbaik dan pelayanan terpercaya</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Mobil</h3>
                <div class="number">{{ $totalMobil ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3>Mobil Tersedia</h3>
                <div class="number">{{ $mobilTersedia ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3>Mobil Disewa</h3>
                <div class="number">{{ $mobilDisewa ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Penyewaan</h3>
                <div class="number">{{ $totalPenyewaan ?? 0 }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="weather-widget">
            <div class="weather-header">
                <i class="fas fa-cloud-sun"></i> Cuaca Surabaya
            </div>
            <div id="weatherLoading" class="text-center py-3">
                <div class="spinner-border spinner-border-sm text-primary"></div>
                <p class="small mt-1">Loading...</p>
            </div>
            <div id="weatherResult" class="d-none text-center">
                <div class="weather-temp-large">
                    <span id="widgetTemp">--</span>°C
                </div>
                <div class="weather-desc-small" id="widgetDesc">--</div>
                <div class="weather-details">
                    <span><i class="fas fa-tint"></i> <span id="widgetHumidity">--</span>%</span>
                    <span><i class="fas fa-wind"></i> <span id="widgetWind">--</span> km/h</span>
                </div>
            </div>
            <div id="weatherError" class="text-warning small text-center d-none">
                <i class="fas fa-exclamation-triangle"></i> Gagal ambil data
            </div>
        </div>
    </div>
</div>

<div class="section-title">
    <h2>🔥 Mobil Populer</h2>
</div>
<div class="gallery" id="popularMobilContainer"></div>

<div class="section-title" style="margin-top: 40px;">
    <h2>⭐ Riwayat Penilaian Penyewaan</h2>
</div>
<div class="testimoni-grid" id="testimoniContainer"></div>
@endsection

@push('styles')
<style>
    .weather-widget {
        background: linear-gradient(135deg, #1e4a76, #2c5f8a);
        border-radius: 20px;
        padding: 15px;
        color: white;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .weather-header {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 10px;
        opacity: 0.9;
    }
    .weather-temp-large {
        font-size: 42px;
        font-weight: 700;
        text-align: center;
        line-height: 1;
    }
    .weather-desc-small {
        text-align: center;
        font-size: 14px;
        margin: 8px 0;
        text-transform: capitalize;
    }
    .weather-details {
        display: flex;
        justify-content: center;
        gap: 20px;
        font-size: 12px;
        margin-top: 10px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    @media (min-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    async function loadWeatherWidget() {
        try {
            const response = await fetch('/api/cuaca');
            const json = await response.json();

            if (json.success && json.data) {
                document.getElementById('widgetTemp').innerHTML = json.data.temp;
                document.getElementById('widgetDesc').innerHTML = json.data.description;
                document.getElementById('widgetHumidity').innerHTML = json.data.humidity;
                document.getElementById('widgetWind').innerHTML = json.data.wind;

                document.getElementById('weatherLoading').classList.add('d-none');
                document.getElementById('weatherResult').classList.remove('d-none');
            } else {
                throw new Error('Gagal');
            }
        } catch (err) {
            document.getElementById('weatherLoading').classList.add('d-none');
            document.getElementById('weatherError').classList.remove('d-none');
            console.error('Weather error:', err);
        }
    }

    loadWeatherWidget();
</script>
@endpush
