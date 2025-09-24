<?php

namespace App\Http\Controllers;

use App\Models\Doa;
use Illuminate\Http\Request;

class DoaController extends Controller
{
    // Ambil semua doa (gabungan API + DB lokal)
    public function index()
    {
        // ambil doa dari database
        $localDoas = Doa::all();

        return response()->json([
            'local' => $localDoas
        ]);
    }

    // Simpan doa baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:255',
            'arab'      => 'required|string',
            'latin'       => 'required|string',
            'artinya' => 'required|string',
        ]);

        $doa = Doa::create($validated);

        return response()->json([
            'message' => 'Doa berhasil ditambahkan',
            'data'    => $doa
        ], 201);
    }

    // Lihat doa lokal berdasarkan id
    public function show($id)
    {
        $doa = Doa::find($id);

        if (!$doa) {
            return response()->json(['error' => 'Doa tidak ditemukan'], 404);
        }

        return response()->json($doa);
    }
}
