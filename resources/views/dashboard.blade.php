<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DriveNow - Rental Mobil Terpercaya">
    <title>DriveNow | Home - Rental Mobil</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<header>
    <div class="header-left">
        <img id="logo" src="{{ asset('logo.png') }}" alt="Logo DriveNow" onerror="this.src='https://placehold.co/80x80/1e4a76/white?text=DN'">
    </div>
    <div class="header-center">
        <h1>DriveNow - Rental Mobil</h1>
        <p>Sewa mobil mudah, cepat, dan terpercaya</p>
    </div>
    <button id="darkModeBtn" onclick="toggleDarkMode()">🌙</button>
</header>

<nav>
    <a href="{{ route('dashboard') }}" class="active">Home</a>
    <a href="{{ route('cars.index') }}">Kelola Mobil</a>
    <a href="{{ route('rentals.index') }}">Penyewaan</a>
    <a href="{{ route('tentang') }}">Tentang</a>
</nav>

<main>
    <div class="hero">
        <h2>Selamat Datang di DriveNow</h2>
        <p>Sewa mobil favorit Anda dengan harga terbaik dan pelayanan terpercaya</p>
    </div>

    <div class="stats-grid" id="statsContainer">
        <div class="stat-card">
            <h3>Total Mobil</h3>
            <div class="number" id="totalMobil">0</div>
        </div>
        <div class="stat-card">
            <h3>Mobil Tersedia</h3>
            <div class="number" id="mobilTersedia">0</div>
        </div>
        <div class="stat-card">
            <h3>Mobil Disewa</h3>
            <div class="number" id="mobilDisewa">0</div>
        </div>
        <div class="stat-card">
            <h3>Total Penyewaan</h3>
            <div class="number" id="totalPenyewaan">0</div>
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
</main>

<footer>
    <p>&copy; 2026 DriveNow Rental Mobil</p>
</footer>

<div id="scrollToTop">↑</div>
<script src="{{ asset('script.js') }}"></script>
</body>
</html>
