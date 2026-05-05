<div class="stat-card" style="background: {{ $warna ?? '#e8f0f8' }}; padding: 20px; border-radius: 10px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <div style="font-size: 40px; margin-bottom: 10px;">{{ $ikon ?? '📊' }}</div>
    <h3 style="margin: 10px 0; font-size: 14px; color: #64748b;">{{ $judul }}</h3>
    <div style="font-size: 28px; font-weight: bold; color: #1e4a76;">{{ $nilai ?? '0' }}</div>
</div>
