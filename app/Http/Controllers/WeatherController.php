<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather');
    }

    public function fetch()
    {
        try {
            $response = Http::get('https://wttr.in/Surabaya?format=j1');

            if ($response->successful()) {
                $data = $response->json();

                $weather = [
                    'city' => 'Surabaya',
                    'temp' => $data['current_condition'][0]['temp_C'] ?? 'N/A',
                    'description' => $data['current_condition'][0]['weatherDesc'][0]['value'] ?? 'N/A',
                    'humidity' => $data['current_condition'][0]['humidity'] ?? 'N/A',
                    'wind' => $data['current_condition'][0]['windspeedKmph'] ?? 'N/A',
                ];

                return response()->json([
                    'success' => true,
                    'data' => $weather
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data cuaca'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
