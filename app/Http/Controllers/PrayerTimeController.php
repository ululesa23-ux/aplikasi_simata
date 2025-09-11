<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PrayerTimeController extends Controller
{
    public function getTimes(Request $request)
    {
        // Ambil latitude & longitude dari query parameter
        $lat = $request->query('lat', '-6.200000');   // default: Jakarta
        $long = $request->query('long', '106.816666'); // default: Jakarta
        $method = $request->query('method', 2); // 2 = Muslim World League

        // Panggil API Aladhan
        $response = Http::get("https://api.aladhan.com/v1/timings", [
            'latitude' => $lat,
            'longitude' => $long,
            'method' => $method,
        ]);

        return $response->json();
    }
}
