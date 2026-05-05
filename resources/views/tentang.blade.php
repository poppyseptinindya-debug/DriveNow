@extends('layouts.app')

@section('title', 'DriveNow | Tentang Kami')
@section('active-tentang', 'class="active"')

@section('content')
<div class="hero">
    <h2>Tentang DriveNow</h2>
    <p>Kenali lebih dekat layanan rental mobil terpercaya kami</p>
</div>

<div class="form-container" style="max-width: 900px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 30px;">
        <div style="font-size: 70px; margin-bottom: 10px;">🚗</div>
        <h2 style="color: var(--primary); margin: 0;">DriveNow</h2>
        <p style="color: var(--text-light);">Sistem Informasi Manajemen Rental Mobil</p>
    </div>

    <div style="margin-bottom: 30px;">
        <h3>🎯 Visi & Misi</h3>
        <p><strong>Visi:</strong> Menjadi platform rental mobil terbesar dan terpercaya di Indonesia.</p>
        <p><strong>Misi:</strong></p>
        <ul>
            <li>Menyediakan layanan rental mobil yang mudah diakses</li>
            <li>Menawarkan harga yang transparan tanpa biaya tersembunyi</li>
            <li>Memberikan pelayanan profesional dan ramah</li>
            <li>Menjaga kualitas dan kebersihan armada mobil</li>
        </ul>
    </div>

    <div style="margin-bottom: 30px;">
        <h3>✅ Keunggulan Kami</h3>
        <ul>
            <li>🚗 <strong>Beragam Pilihan Mobil</strong> - Dari city car hingga SUV</li>
            <li>💰 <strong>Harga Terjangkau</strong> - Tanpa biaya tersembunyi</li>
            <li>🔧 <strong>Mobil Terawat</strong> - Servis rutin berkala</li>
            <li>📞 <strong>Layanan 24/7</strong> - Customer service siap membantu</li>
        </ul>
    </div>

    <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--gray-light);">
        <a href="{{ route('dashboard') }}" class="btn-primary">🏠 Kembali ke Home</a>
    </div>
</div>
@endsection
