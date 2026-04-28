<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveNow | Kelola Mobil</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<header>
    <div class="header-left">
        <img id="logo" src="{{ asset('logo.png') }}" alt="Logo DriveNow" onerror="this.src='https://placehold.co/80x80/1e4a76/white?text=DN'">
    </div>
    <div class="header-center">
        <h1>DriveNow - Rental Mobil</h1>
        <p>Kelola data mobil</p>
    </div>
    <button id="darkModeBtn" onclick="toggleDarkMode()">🌙</button>
</header>

<nav>
    <a href="{{ route('dashboard') }}">Home</a>
    <a href="{{ route('cars.index') }}" class="active">Kelola Mobil</a>
    <a href="{{ route('rentals.index') }}">Penyewaan</a>
    <a href="{{ route('tentang') }}">Tentang</a>
</nav>

<main>
    <div class="section-title">
        <h2>Daftar Mobil</h2>
        <button class="btn-primary" onclick="openMobilModal()">+ Tambah Mobil</button>
    </div>

    <div class="search-bar">
        <input type="text" id="searchMobil" placeholder="🔍 Cari mobil..." onkeyup="filterMobil()">
        <select id="filterStatus" onchange="filterMobil()">
            <option value="">Semua Status</option>
            <option value="Tersedia">Tersedia</option>
            <option value="Disewa">Disewa</option>
        </select>
    </div>

    <div id="kelompokMobilContainer"></div>

    <div class="section-title" style="margin-top: 40px;">
        <h2>Riwayat Penyewaan</h2>
    </div>
    <div class="table-container">
         <table>
            <thead>
                <tr><th>No</th><th>Nama Penyewa</th><th>Mobil</th><th>Tanggal Sewa</th><th>Lama</th><th>Total</th><th>Status</th></tr>
            </thead>
            <tbody id="riwayatSewaBody">
                <tr><td colspan="7" style="text-align:center">Loading...</td></tr>
            </tbody>
         </table>
    </div>
</main>

<footer>
    <p>&copy; 2026 DriveNow Rental Mobil</p>
</footer>

<div id="modalMobil" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalMobilTitle">Tambah Mobil</h3>
            <span class="close-modal" onclick="closeMobilModal()">&times;</span>
        </div>
        <form id="formMobil">
            <input type="hidden" id="mobilId">
            <div class="form-group">
                <label>Nama Mobil</label>
                <input type="text" id="namaMobil" required placeholder="Contoh: Toyota Avanza">
            </div>
            <div class="form-group">
                <label>Jenis Mobil</label>
                <select id="jenisMobil" required>
                    <option value="MPV">MPV</option>
                    <option value="SUV">SUV</option>
                    <option value="City Car">City Car</option>
                    <option value="Sedan">Sedan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Harga per Hari (Rp)</label>
                <input type="number" id="hargaMobil" required min="50000" placeholder="350000">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select id="statusMobil" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Disewa">Disewa</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gambar Mobil</label>
                <input type="file" id="gambarMobil" accept="image/jpeg,image/png,image/jpg">
                <small style="color:var(--text-light)">Pilih file gambar dari komputer (jpg, png)</small>
                <div id="previewGambar" style="margin-top: 10px; display: none;">
                    <img id="previewImg" src="#" alt="Preview" style="width: 100px; height: 80px; object-fit: cover; border-radius: 8px;">
                </div>
            </div>
            <button type="submit" class="btn-primary" style="width:100%">Simpan</button>
        </form>
    </div>
</div>

<div id="scrollToTop">↑</div>
<script src="{{ asset('script.js') }}"></script>
</body>
</html>
