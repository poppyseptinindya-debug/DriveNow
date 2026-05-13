<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Jika admin, lihat semua penyewaan
        if (auth()->user()->role === 'admin') {
            $rentals = Rental::with(['car', 'user'])->latest()->paginate(10);
        }
        // Jika customer, lihat hanya penyewaan miliknya sendiri
        else {
            $rentals = Rental::where('user_id', auth()->id())
                        ->with('car')
                        ->latest()
                        ->paginate(10);
        }

        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $cars = Car::where('status', 'Tersedia')->get();
        return view('rentals.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'rental_date' => 'required|date',
            'days' => 'required|integer|min:1|max:30',
        ]);

        $car = Car::findOrFail($request->car_id);

        if ($car->status !== 'Tersedia') {
            return back()->with('error', 'Mobil tidak tersedia!');
        }

        $total_price = $car->harga * $request->days;

        Rental::create([
            'car_id' => $request->car_id,
            'user_id' => auth()->id(),  // INI PENTING!
            'rental_date' => $request->rental_date,
            'days' => $request->days,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        $car->update(['status' => 'Disewa']);

        return redirect()->route('rentals.index')->with('success', 'Penyewaan berhasil!');
    }

    // method lainnya tetap sama...
}
