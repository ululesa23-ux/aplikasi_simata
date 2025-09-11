<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DoaController extends Controller
{
    // Ambil semua doa
    public function index()
    {
        $response = Http::get('https://doa-doa-api-ahmadramadhan.fly.dev/api');
        
        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Gagal mengambil data doa'], 500);
    }

    // Ambil doa berdasarkan id
    public function show($id)
    {
        $response = Http::get("https://doa-doa-api-ahmadramadhan.fly.dev/api/{$id}");

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Doa tidak ditemukan'], 404);
    }
}
