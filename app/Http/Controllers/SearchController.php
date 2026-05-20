<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request): JsonResponse
    {
        $keyword = $request->input('q', '');

        $cars = Car::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('nama', 'like', "%{$keyword}%")
                             ->orWhere('jenis', 'like', "%{$keyword}%");
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $cars,
            'total' => $cars->count(),
            'keyword' => $keyword
        ]);
    }
}
