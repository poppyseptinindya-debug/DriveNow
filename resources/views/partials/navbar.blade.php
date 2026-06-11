<!-- Header Banner with Brand Logo -->
<header class="bg-gradient-to-r from-primary to-primary-dark text-white px-6 py-5 flex items-center justify-between shadow-md transition-colors duration-300">
    <div class="flex items-center gap-4">
        <a href="{{ route('home') }}">
            <img id="logo" src="{{ asset('logo.png') }}" alt="Logo DriveNow" class="h-28 w-auto transition-transform hover:scale-105 duration-300" onerror="this.src='https://placehold.co/80x80/1e4a76/white?text=DN'">
        </a>
    </div>
    <div class="flex-grow text-center hidden sm:flex flex-col items-center justify-center">
        <h1 class="text-3xl font-extrabold tracking-wider leading-tight">DriveNow</h1>
        <p class="text-base font-semibold tracking-wide text-slate-100">Rental Mobil</p>
        <p class="text-xs opacity-85 mt-0.5">Sewa mobil mudah, cepat, dan terpercaya</p>
    </div>
    <div class="flex items-center gap-3">
        <!-- Theme Toggle Button -->
        <button id="themeToggleBtn" onclick="toggleTheme()" class="h-10 w-10 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all">
            <i id="themeToggleIcon" class="fas fa-moon"></i>
        </button>
    </div>
</header>

<!-- Navigation Menu -->
<nav x-data="{ open: false }" class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 transition-colors duration-300 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <!-- Left Navigation Links -->
            <div class="flex items-center">
                <div class="hidden md:flex items-center space-x-1">
                    @guest
                        <a href="{{ route('home') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('home') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Home</a>
                        <a href="{{ route('cars.catalog') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('cars.catalog') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Katalog</a>
                        <a href="{{ route('tentang') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('tentang') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Tentang</a>
                        <a href="{{ route('kontak') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('kontak') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Kotak Saran</a>
                    @else
                        @if(Auth::user()->isAdmin())
                            <!-- Admin Nav Items -->
                            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Dashboard Admin</a>
                            <a href="{{ route('admin.cars.index') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.cars.*') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Kelola Mobil</a>
                            <a href="{{ route('admin.rentals.index') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.rentals.*') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Penyewaan</a>
                            <a href="{{ route('admin.customers.index') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.customers.*') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Pelanggan</a>
                            <a href="{{ route('admin.contacts.index') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.contacts.*') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Kotak Saran</a>
                        @else
                            <!-- Customer Nav Items -->
                            <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Dashboard</a>
                            <a href="{{ route('cars.catalog') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('cars.*') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Katalog</a>
                            <a href="{{ route('rentals.history') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('rentals.*') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Riwayat Sewa</a>
                            <a href="{{ route('tentang') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('tentang') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Tentang</a>
                            <a href="{{ route('kontak') }}" class="px-3 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('kontak') ? 'bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light' }}">Kotak Saran</a>
                        @endif
                    @endguest
                </div>
            </div>

            <!-- Right Controls -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <!-- User Profile & Role Info -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all">{{ Auth::user()->name }}</p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-primary-soft text-primary dark:bg-primary-dark/40 dark:text-primary-light font-mono">
                                    {{ strtoupper(Auth::user()->role) }}
                                </span>
                            </div>
                            <div class="h-9 w-9 flex items-center justify-center rounded-xl bg-slate-50 hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 transition-all group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                <i class="fas fa-user-cog"></i>
                            </div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="h-9 w-9 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 dark:hover:bg-rose-950/50 text-rose-600 dark:text-rose-400 transition-all" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Authentication Links -->
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary-light">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-xl transition-all shadow-sm">Daftar</a>
                @endauth
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="flex items-center md:hidden gap-3">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 transition-all">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @guest
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Home</a>
                <a href="{{ route('cars.catalog') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Katalog</a>
                <a href="{{ route('tentang') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Tentang</a>
                <a href="{{ route('kontak') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Kotak Saran</a>
            @else
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Dashboard Admin</a>
                    <a href="{{ route('admin.cars.index') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Kelola Mobil</a>
                    <a href="{{ route('admin.rentals.index') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Penyewaan</a>
                    <a href="{{ route('admin.customers.index') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Pelanggan</a>
                    <a href="{{ route('admin.contacts.index') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Kotak Saran</a>
                @else
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Dashboard</a>
                    <a href="{{ route('cars.catalog') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Katalog</a>
                    <a href="{{ route('rentals.history') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Riwayat Sewa</a>
                    <a href="{{ route('tentang') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Tentang</a>
                    <a href="{{ route('kontak') }}" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">Kotak Saran</a>
                @endif
            @endguest
        </div>

        @auth
            <div class="pt-4 pb-3 border-t border-slate-200 dark:border-slate-800 px-4 flex items-center justify-between">
                <a href="{{ route('profile.edit') }}" class="block">
                    <p class="text-base font-semibold text-slate-800 dark:text-slate-100">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400"><i class="fas fa-cog mr-1"></i> Pengaturan Akun</p>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/20 dark:text-rose-400 rounded-xl transition-all">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-slate-200 dark:border-slate-800 px-4 flex gap-3">
                <a href="{{ route('login') }}" class="flex-1 text-center py-2 text-sm font-medium text-slate-700 bg-slate-100 dark:bg-slate-800 dark:text-slate-300 rounded-xl">Login</a>
                <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-sm font-medium text-white bg-primary rounded-xl">Daftar</a>
            </div>
        @endauth
    </div>


</nav>
