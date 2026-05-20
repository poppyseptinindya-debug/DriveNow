<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DriveNow - Rental Mobil Terpercaya">
    <title>@yield('title', 'DriveNow')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    @stack('styles')
    <script>
        // Cookie Helper Functions
        function getCookie(name) {
            const cookies = document.cookie.split(';');
            for (const cookie of cookies) {
                const [key, val] = cookie.trim().split('=');
                if (key === name) return decodeURIComponent(val);
            }
            return null;
        }

        // Apply theme from cookie BEFORE render (prevent flash of unstyled content)
        (function() {
            const theme = getCookie('theme');
            const html = document.documentElement;

            if (theme === 'dark') {
                html.classList.add('dark');
            } else if (theme === 'light') {
                html.classList.remove('dark');
            } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        })();
    </script>
</head>
<body>

@include('partials.navbar')

<main>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} DriveNow Rental Mobil</p>
</footer>

<div id="scrollToTop">↑</div>
<script src="{{ asset('script.js') }}"></script>
@stack('scripts')
</body>
</html>
