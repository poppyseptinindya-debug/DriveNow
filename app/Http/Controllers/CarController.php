<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Admin view of all cars for management.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $cars = Car::when($search, function ($q, $search) {
                return $q->where('nama_mobil', 'like', "%{$search}%")
                         ->orWhere('jenis_mobil', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('cars.index', compact('cars', 'search'));
    }

    /**
     * Admin create car page.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Admin store car.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:100',
            'jenis_mobil' => 'required|in:MPV,SUV,City Car,Sedan',
            'harga_sewa_per_hari' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Disewakan',
            'warna' => 'required|string|max:50',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240'
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('cars', 'public');
        }

        Car::create($validated);
        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil ditambahkan!');
    }

    /**
     * Admin edit car page.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Admin update car.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:100',
            'jenis_mobil' => 'required|in:MPV,SUV,City Car,Sedan',
            'harga_sewa_per_hari' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Disewakan',
            'warna' => 'required|string|max:50',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240'
        ]);

        if ($request->hasFile('gambar')) {
            if ($car->gambar) {
                Storage::disk('public')->delete($car->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('cars', 'public');
        }

        $car->update($validated);
        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil diperbarui!');
    }

    /**
     * Admin delete car.
     */
    public function destroy(Car $car)
    {
        if ($car->gambar) {
            Storage::disk('public')->delete($car->gambar);
        }
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil dihapus!');
    }

    /**
     * Customer catalog view.
     */
    public function catalog(Request $request)
    {
        $search = $request->query('search');
        $cars = Car::when($search, function ($q, $search) {
                return $q->where('nama_mobil', 'like', "%{$search}%")
                         ->orWhere('jenis_mobil', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('cars.catalog', compact('cars', 'search'));
    }

    /**
     * Customer detail view.
     */
    public function customerShow(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * API for live search. Returns JSON.
     */
    public function searchApi(Request $request)
    {
        $query = $request->input('q', '');

        $cars = Car::query()
            ->when($query, function ($q, $search) {
                return $q->where('nama_mobil', 'like', "%{$search}%")
                         ->orWhere('jenis_mobil', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        // Map images to public asset path for JS
        $cars->transform(function ($car) {
            if ($car->gambar) {
                $car->gambar_url = str_starts_with($car->gambar, 'cars/') 
                    ? asset('storage/' . $car->gambar) 
                    : asset($car->gambar);
            } else {
                $car->gambar_url = 'https://placehold.co/300x170?text=' . urlencode($car->nama_mobil);
            }
            return $car;
        });

        return response()->json([
            'success' => true,
            'data' => $cars
        ]);
    }
}
