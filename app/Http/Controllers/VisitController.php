<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $jumlah = session('visit_count', 0);
        $pertama = session('visit_first', 'Belum ada kunjungan');
        $terakhir = session('visit_last', 'Belum ada kunjungan');

        return view('visits', compact('jumlah', 'pertama', 'terakhir'));
    }

    public function reset()
    {
        session()->forget(['visit_count', 'visit_first', 'visit_last']);

        return response()->json([
            'success' => true,
            'message' => 'Hitungan kunjungan direset'
        ]);
    }
}
