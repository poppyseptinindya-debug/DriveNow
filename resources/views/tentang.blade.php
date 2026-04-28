<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DriveNow - Rental Mobil Terpercaya">
    <title>DriveNow | Tentang</title>
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
    <a href="{{ route('dashboard') }}">Home</a>
    <a href="{{ route('cars.index') }}">Kelola Mobil</a>
    <a href="{{ route('rentals.index') }}">Penyewaan</a>
    <a href="{{ route('tentang') }}">Tentang</a>
</nav>

<main>
    <div class="hero">
        <h2>Tentang DriveNow</h2>
        <p>Kenali lebih dekat layanan rental mobil terpercaya kami</p>
    </div>

    <div class="form-container" style="max-width: 900px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="color: var(--primary); margin: 0;">DriveNow</h2>
            <p style="color: var(--text-light); margin-top: 5px;">Sistem Informasi Manajemen Rental Mobil</p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3>🎯 Visi & Misi</h3>
            <p><strong>Visi:</strong> Menjadi platform rental mobil terbesar dan terpercaya di Indonesia.</p>
            <p><strong>Misi:</strong> Menyediakan layanan rental mobil yang mudah diakses, harga transparan, dan pelayanan profesional.</p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3>✅ Keunggulan Kami</h3>
            <ul style="list-style: none; padding: 0;">
                <li>🚗 <strong>Beragam Pilihan Mobil</strong> - Dari city car hingga SUV</li>
                <li>💰 <strong>Harga Terjangkau</strong> - Tanpa biaya tersembunyi</li>
                <li>🔧 <strong>Mobil Terawat</strong> - Servis rutin berkala</li>
                <li>📞 <strong>Layanan 24/7</strong> - Customer service siap membantu</li>
            </ul>
        </div>

        <div style="margin-bottom: 30px;">
            <h3>📞 Kontak Kami</h3>
            <p>📧 Email: info@drivenow.com</p>
            <p>📱 Telepon: (+62) 812-1624-7073</p>
        </div>

    </div>
</main>

<footer>
    <p>&copy; 2026 DriveNow Rental Mobil</p>
</footer>

<div id="scrollToTop">↑</div>
<script src="{{ asset('script.js') }}"></script>
</body>
</html>
