<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalMobil = Car::count();
        $mobilTersedia = Car::where('status', 'Tersedia')->count();
        $mobilDisewa = Car::where('status', 'Disewakan')->count();
        $totalCustomer = User::where('role', 'customer')->count();
        $totalPenyewaan = Rental::count();

        return view('admin.dashboard', compact(
            'totalMobil',
            'mobilTersedia',
            'mobilDisewa',
            'totalCustomer',
            'totalPenyewaan'
        ));
    }

    public function customers()
    {
        $customers = User::where('role', 'customer')->latest()->paginate(10);
        return view('admin.customers', compact('customers'));
    }

    public function contactsIndex()
    {
        $contacts = \App\Models\Contact::latest()->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }

    public function destroyContact(\App\Models\Contact $contact)
    {
        $contact->delete();
        return response()->json([
            'success' => true,
            'message' => 'Saran pelanggan berhasil dihapus.'
        ]);
    }
}
