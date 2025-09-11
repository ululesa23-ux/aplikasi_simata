<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class QuranController extends Controller
{
    // Ambil daftar semua surat
    public function listSurat()
    {
        $response = Http::get('https://equran.id/api/v2/surat');
        return response()->json($response->json());
    }

    // Ambil detail surat berdasarkan nomor
    public function detailSurat($nomor)
    {
        $response = Http::get("https://equran.id/api/v2/surat/{$nomor}");
        return response()->json($response->json());
    }
}
