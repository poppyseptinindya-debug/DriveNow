@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="alert alert-success">
        <h4>Selamat Datang, Admin {{ Auth::user()->name }}!</h4>
        <p>Ini adalah halaman khusus administrator.</p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5>Total Mobil</h5>
                    <h3>{{ App\Models\Car::count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5>Mobil Tersedia</h5>
                    <h3>{{ App\Models\Car::where('status', 'Tersedia')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5>Total User</h5>
                    <h3>{{ App\Models\User::count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Menu Admin
        </div>
        <div class="card-body">
            <a href="{{ route('cars.create') }}" class="btn btn-primary">Tambah Mobil</a>
            <a href="{{ route('cars.index') }}" class="btn btn-info">Kelola Mobil</a>
        </div>
    </div>
</div>
@endsection
