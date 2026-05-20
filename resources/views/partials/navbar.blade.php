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
    <a href="{{ route('search.index') }}" class="nav-link"><i class="fas fa-search"></i> Live Search</a>
    <a href="{{ route('preferences.index') }}" class="nav-link"><i class="fas fa-sliders-h"></i> Pengaturan</a>
    <a href="{{ route('visits.index') }}" class="nav-link"><i class="fas fa-chart-line"></i> Kunjungan</a>

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

    <button id="darkModeToggle" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; margin-left: 15px;">
        <i id="darkModeIcon" class="fas fa-moon"></i>
    </button>

    <script>
        function setCookie(name, value, days = 365) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${encodeURIComponent(value)};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
        }

        function getCookie(name) {
            const cookies = document.cookie.split(';');
            for (const cookie of cookies) {
                const [key, val] = cookie.trim().split('=');
                if (key === name) return decodeURIComponent(val);
            }
            return null;
        }

        const toggleBtn = document.getElementById('darkModeToggle');
        const icon = document.getElementById('darkModeIcon');
        const html = document.documentElement;

        function updateDarkMode(isDark) {
            if (isDark) {
                html.classList.add('dark');
                setCookie('theme', 'dark', 365);
                icon.className = 'fas fa-sun';
            } else {
                html.classList.remove('dark');
                setCookie('theme', 'light', 365);
                icon.className = 'fas fa-moon';
            }
        }

        // Set initial icon
        if (html.classList.contains('dark')) {
            icon.className = 'fas fa-sun';
        } else {
            icon.className = 'fas fa-moon';
        }

        toggleBtn.addEventListener('click', () => {
            const isDark = !html.classList.contains('dark');
            updateDarkMode(isDark);
        });
    </script>
</nav>
