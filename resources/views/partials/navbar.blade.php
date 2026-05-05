<header>
    <div class="header-left">
        <img id="logo" src="{{ asset('logo.png') }}" alt="Logo DriveNow">
    </div>
    <div class="header-center">
        <h1>DriveNow - Rental Mobil</h1>
        <p>Sewa mobil mudah, cepat, dan terpercaya</p>
    </div>
    <button id="darkModeBtn" onclick="toggleDarkMode()">🌙</button>
</header>

<nav>
    <a href="{{ route('dashboard') }}" @yield('active-dashboard')>Home</a>
    <a href="{{ route('cars.index') }}" @yield('active-cars')>Kelola Mobil</a>
    <a href="{{ route('rentals.index') }}" @yield('active-rentals')>Penyewaan</a>
    <a href="{{ route('tentang') }}" @yield('active-tentang')>Tentang</a>
    <a href="{{ route('kontak') }}" @yield('active-kontak')>Kontak</a>
</nav>
