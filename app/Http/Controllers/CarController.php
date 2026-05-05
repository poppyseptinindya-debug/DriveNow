<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Menampilkan data
    public function index()
    {
        $cars = Car::all();
        return view('cars', compact('cars'));
    }

    public function store(Request $request)
    {
        Car::create($request->all());

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Car::find($id)->delete();

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        // Jika validasi gagal
        return redirect()->back()->with('error', 'Data gagal disimpan!');
    }
}
