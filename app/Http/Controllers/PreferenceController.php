<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PreferenceController extends Controller
{
    public function index()
    {
        return view('preferences');
    }

    public function save(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'theme' => 'required|in:light,dark,system',
            'font_size' => 'required|in:small,medium,large'
        ]);

        $cookieTheme = cookie('theme', $validated['theme'], 60 * 24 * 365);
        $cookieFont = cookie('font_size', $validated['font_size'], 60 * 24 * 365);

        return response()->json([
            'success' => true,
            'message' => 'Preferensi berhasil disimpan'
        ])->withCookie($cookieTheme)->withCookie($cookieFont);
    }
}
