<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="DriveNow - Sewa Mobil Premium Cepat & Mudah">
    <title>@yield('title', 'DriveNow | Sewa Mobil Terpercaya')</title>
    
    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles & Scripts from Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Dark Mode FOUC Prevention Script -->
    <script src="{{ asset('js/theme-init.js') }}"></script>
    @stack('styles')
</head>
<body class="font-['Poppins',sans-serif] h-full flex flex-col bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-200 transition-colors duration-300">

    <!-- Navbar Partial -->
    @include('partials.navbar')

    <!-- Main Content Grid -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div id="toast-success" class="flex items-center w-full max-w-md p-4 mb-4 text-slate-500 bg-white rounded-2xl shadow-lg dark:text-slate-400 dark:bg-slate-900 border border-emerald-100 dark:border-emerald-950/50" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-emerald-100 rounded-lg dark:bg-emerald-900/40 dark:text-emerald-400">
                    <i class="fas fa-check"></i>
                </div>
                <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
                <button type="button" onclick="this.parentElement.remove()" class="ms-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-slate-900 rounded-lg focus:ring-2 focus:ring-slate-300 p-1.5 hover:bg-slate-100 inline-flex items-center justify-center h-8 w-8 dark:text-slate-500 dark:hover:text-white dark:bg-slate-900 dark:hover:bg-slate-800" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div id="toast-error" class="flex items-center w-full max-w-md p-4 mb-4 text-slate-500 bg-white rounded-2xl shadow-lg dark:text-slate-400 dark:bg-slate-900 border border-rose-100 dark:border-rose-950/50" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-rose-500 bg-rose-100 rounded-lg dark:bg-rose-900/40 dark:text-rose-400">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="ms-3 text-sm font-medium">{{ session('error') }}</div>
                <button type="button" onclick="this.parentElement.remove()" class="ms-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-slate-900 rounded-lg focus:ring-2 focus:ring-slate-300 p-1.5 hover:bg-slate-100 inline-flex items-center justify-center h-8 w-8 dark:text-slate-500 dark:hover:text-white dark:bg-slate-900 dark:hover:bg-slate-800" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 dark:bg-slate-900 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-center items-center">
            <p class="text-sm text-slate-500 dark:text-slate-400">&copy; 2026 DriveNow. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
