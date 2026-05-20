@extends('layouts.app')

@section('title', 'Pengaturan - DriveNow')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-sliders-h"></i> Pengaturan</h4>
                </div>
                <div class="card-body">
                    <div id="flashMsg" class="alert d-none"></div>

                    <form id="preferenceForm">
                        @csrf

                        {{-- TEMA --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">🎨 Tema</label>
                            <select id="theme" class="form-select">
                                <option value="light">☀️ Terang</option>
                                <option value="dark">🌙 Gelap</option>
                                <option value="system">🖥️ Ikuti Sistem</option>
                            </select>
                            <small class="text-muted">Tema akan tersimpan di cookie selama 1 tahun</small>
                        </div>

                        {{-- UKURAN FONT --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">🔤 Ukuran Font</label>
                            <select id="fontSize" class="form-select">
                                <option value="small">🔹 Kecil</option>
                                <option value="medium">🔸 Sedang</option>
                                <option value="large">🔹 Besar</option>
                            </select>
                            <small class="text-muted">Ukuran font akan tersimpan di cookie</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Simpan Pengaturan
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <button id="resetCookieBtn" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Reset Semua Cookie
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';

    function getCookie(name) {
        const cookies = document.cookie.split(';');
        for (const cookie of cookies) {
            const [key, val] = cookie.trim().split('=');
            if (key === name) return decodeURIComponent(val);
        }
        return null;
    }

    function setCookie(name, value, days = 365) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${encodeURIComponent(value)};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
    }

    function deleteCookie(name) {
        document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;`;
    }

    // Load saved preferences
    document.getElementById('theme').value = getCookie('theme') || 'system';
    document.getElementById('fontSize').value = getCookie('font_size') || 'medium';

    // Apply font size
    const fontSize = getCookie('font_size') || 'medium';
    if (fontSize === 'small') {
        document.body.style.fontSize = '14px';
    } else if (fontSize === 'large') {
        document.body.style.fontSize = '18px';
    } else {
        document.body.style.fontSize = '16px';
    }

    // Save preferences via Fetch POST
    document.getElementById('preferenceForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const theme = document.getElementById('theme').value;
        const fontSize = document.getElementById('fontSize').value;
        const flashMsg = document.getElementById('flashMsg');

        try {
            const response = await fetch('{{ route("preferences.save") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                body: JSON.stringify({ theme, font_size: fontSize })
            });

            const json = await response.json();

            if (json.success) {
                flashMsg.className = 'alert alert-success';
                flashMsg.innerHTML = `<i class="fas fa-check-circle"></i> ${json.message}`;
                flashMsg.classList.remove('d-none');

                // Apply theme
                const html = document.documentElement;
                if (theme === 'dark') {
                    html.classList.add('dark');
                } else if (theme === 'light') {
                    html.classList.remove('dark');
                } else if (theme === 'system') {
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        html.classList.add('dark');
                    } else {
                        html.classList.remove('dark');
                    }
                }

                // Apply font size
                if (fontSize === 'small') {
                    document.body.style.fontSize = '14px';
                } else if (fontSize === 'large') {
                    document.body.style.fontSize = '18px';
                } else {
                    document.body.style.fontSize = '16px';
                }

                setTimeout(() => flashMsg.classList.add('d-none'), 3000);
            }
        } catch (err) {
            flashMsg.className = 'alert alert-danger';
            flashMsg.innerHTML = `<i class="fas fa-exclamation-circle"></i> Error: ${err.message}`;
            flashMsg.classList.remove('d-none');
        }
    });

    // Reset cookies
    document.getElementById('resetCookieBtn').addEventListener('click', () => {
        if (confirm('Reset semua pengaturan? Tema akan kembali ke sistem, font ke sedang.')) {
            deleteCookie('theme');
            deleteCookie('font_size');

            // Reset theme
            const html = document.documentElement;
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }

            // Reset font size
            document.body.style.fontSize = '16px';

            // Reset form
            document.getElementById('theme').value = 'system';
            document.getElementById('fontSize').value = 'medium';

            location.reload();
        }
    });
</script>
@endsection
