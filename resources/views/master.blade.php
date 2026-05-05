<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DriveNow - Rental Mobil Terpercaya">
    <title>@yield('title', 'DriveNow')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @stack('styles')
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
    <a href="{{ route('dashboard') }}" @yield('active-dashboard')>Home</a>
    <a href="{{ route('cars.index') }}" @yield('active-cars')>Kelola Mobil</a>
    <a href="{{ route('rentals.index') }}" @yield('active-rentals')>Penyewaan</a>
    <a href="{{ route('tentang') }}" @yield('active-tentang')>Tentang</a>
</nav>

<main>
    @if(session('success'))
        <div class="alert alert-success" style="background: #d4f0e0; color: #4a7a5a; padding: 12px; border-radius: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" style="background: #f0d4d4; color: #aa7a7a; padding: 12px; border-radius: 10px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

<footer>
    <p>&copy; 2026 DriveNow Rental Mobil</p>
</footer>

<div id="scrollToTop">↑</div>
<script src="{{ asset('script.js') }}"></script>
@stack('scripts')
</body>
</html>
