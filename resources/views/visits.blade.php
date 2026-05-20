@extends('layouts.app')

@section('title', 'Statistik Kunjungan - DriveNow')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="fas fa-chart-line"></i> Statistik Kunjungan</h4>
                </div>
                <div class="card-body text-center">

                    {{-- JUMLAH KUNJUNGAN --}}
                    <div class="mb-4">
                        <div class="display-1 fw-bold text-primary">{{ $jumlah }}</div>
                        <p class="lead">Kali Anda mengunjungi halaman ini</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5><i class="fas fa-calendar-plus"></i> Kunjungan Pertama</h5>
                                    <p class="h6">{{ $pertama }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5><i class="fas fa-calendar-check"></i> Kunjungan Terakhir</h5>
                                    <p class="h6">{{ $terakhir }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 justify-content-center mt-3">
                        <a href="{{ route('visits.index') }}" class="btn btn-primary">
                            <i class="fas fa-sync-alt"></i> Reload (Tambah Kunjungan)
                        </a>
                        <button id="resetBtn" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Reset Hitungan
                        </button>
                    </div>

                    <div class="mt-4">
                        <small class="text-muted">
                            Data ini disimpan di session server, bukan di cookie browser.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    document.getElementById('resetBtn').addEventListener('click', async () => {
        if (confirm('Reset hitungan kunjungan?')) {
            try {
                const response = await fetch('{{ route("visits.reset") }}', {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF
                    }
                });

                const data = await response.json();

                if (data.success) {
                    location.reload();
                }
            } catch (err) {
                alert('Error: ' + err.message);
            }
        }
    });
</script>
@endsection
