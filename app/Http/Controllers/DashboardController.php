<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }
        
        // Show landing page for guests
        $cars = Car::where('status', 'Tersedia')->take(3)->get();
        return view('welcome', compact('cars'));
    }

    public function customerDashboard()
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $totalMobil = Car::count();
        $mobilTersedia = Car::where('status', 'Tersedia')->count();
        $mobilDisewa = Car::where('status', 'Disewakan')->count();
        $totalPenyewaan = Rental::where('user_id', auth()->id())->count();
        
        $mobilPopuler = Car::where('status', 'Tersedia')->latest()->take(3)->get();

        return view('dashboard', compact(
            'totalMobil',
            'mobilTersedia',
            'mobilDisewa',
            'totalPenyewaan',
            'mobilPopuler'
        ));
    }

    public function about()
    {
        return view('tentang');
    }

    public function contact()
    {
        return view('kontak');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|max:2000',
        ]);

        \App\Models\Contact::create($request->only('name', 'email', 'message'));

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Saran dan masukan Anda berhasil dikirimkan langsung kepada admin DriveNow.'
        ]);
    }
}
