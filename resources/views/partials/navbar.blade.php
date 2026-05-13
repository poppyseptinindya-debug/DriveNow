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
    <a href="{{ route('kontak') }}" @yield('active-kontak')>Kontak</a>

    {{-- TAMPILKAN NAMA USER DAN ROLE --}}
    @auth
        <span style="margin-left: 20px; color: #1e4a76; font-weight: bold;">
            👤 {{ Auth::user()->name }} ({{ Auth::user()->role }})
        </span>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           style="margin-left: 15px; color: red;">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <a href="{{ route('login') }}" style="margin-left: 20px;">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>
