@extends('layouts.app')

@section('title', 'Live Search Mobil - DriveNow')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="fas fa-search"></i> Live Search Mobil</h4>
        </div>
        <div class="card-body">
            {{-- FORM SEARCH --}}
            <div class="mb-4">
                <label class="form-label fw-bold">🔍 Cari Mobil</label>
                <input type="text" id="searchInput" class="form-control form-control-lg"
                       placeholder="Ketik nama mobil atau jenis... (MPV, SUV, City Car, Sedan)">
                <small class="text-muted">Hasil akan muncul otomatis setelah selesai mengetik (debounce 400ms)</small>
            </div>

            {{-- LOADING --}}
            <div id="loadingSearch" class="text-center py-4 d-none">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2">Mencari...</p>
            </div>

            {{-- HASIL SEARCH --}}
            <div id="searchResult">
                <div class="alert alert-info">🔍 Ketik kata kunci untuk mencari mobil</div>
            </div>
        </div>
    </div>
</div>

<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
    let debounceTimer;

    async function searchCars(keyword) {
        const resultDiv = document.getElementById('searchResult');
        const loading = document.getElementById('loadingSearch');

        loading.classList.remove('d-none');

        try {
            const url = keyword ? `/api/search?q=${encodeURIComponent(keyword)}` : '/api/search';
            const response = await fetch(url, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF }
            });

            if (!response.ok) throw new Error('Gagal mencari data');

            const json = await response.json();
            renderResult(json.data, json.total, keyword);

        } catch (err) {
            resultDiv.innerHTML = `<div class="alert alert-danger">❌ Error: ${err.message}</div>`;
        } finally {
            loading.classList.add('d-none');
        }
    }

    function renderResult(cars, total, keyword) {
        const resultDiv = document.getElementById('searchResult');

        if (cars.length === 0) {
            resultDiv.innerHTML = `<div class="alert alert-warning">⚠️ Tidak ada mobil ditemukan untuk keyword "${keyword}"</div>`;
            return;
        }

        let html = `<div class="alert alert-success">✅ Ditemukan ${total} mobil</div>`;
        html += '<div class="table-responsive"><table class="table table-bordered table-hover">';
        html += '<thead class="table-dark"><tr><th>No</th><th>Nama Mobil</th><th>Jenis</th><th>Harga/Hari</th><th>Status</th></tr></thead><tbody>';

        cars.forEach((car, index) => {
            let nama = car.nama;
            let jenis = car.jenis;

            // Highlight keyword
            if (keyword) {
                const regex = new RegExp(`(${keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
                nama = nama.replace(regex, '<mark class="bg-warning">$1</mark>');
                jenis = jenis.replace(regex, '<mark class="bg-warning">$1</mark>');
            }

            html += `<tr>
                        <td>${index + 1}</td>
                        <td>${nama}</td>
                        <td>${jenis}</td>
                        <td>Rp ${new Intl.NumberFormat('id-ID').format(car.harga)}</td>
                        <td><span class="badge ${car.status === 'Tersedia' ? 'bg-success' : 'bg-danger'}">${car.status}</span></td>
                      </tr>`;
        });

        html += '</tbody></table></div>';
        resultDiv.innerHTML = html;
    }

    // DEBOUNCE 400ms
    document.getElementById('searchInput').addEventListener('input', function(e) {
        clearTimeout(debounceTimer);
        const keyword = e.target.value.trim();

        debounceTimer = setTimeout(() => {
            searchCars(keyword);
        }, 400);
    });
</script>
@endsection
