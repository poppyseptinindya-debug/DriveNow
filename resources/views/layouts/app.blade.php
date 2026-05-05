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

@include('partials.navbar')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

<main class="container">
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
