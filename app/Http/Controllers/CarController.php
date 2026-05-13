<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jenis' => 'required|in:MPV,SUV,City Car,Sedan',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Disewa',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('cars', 'public');
        }

        Car::create($validated);
        return redirect()->route('cars.index')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function destroy(Car $car)
    {
        if ($car->gambar) {
            \Storage::disk('public')->delete($car->gambar);
        }
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil dihapus!');
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jenis' => 'required|in:MPV,SUV,City Car,Sedan',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Disewa',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($car->gambar) {
                \Storage::disk('public')->delete($car->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('cars', 'public');
        }

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil diperbarui!');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }
}
