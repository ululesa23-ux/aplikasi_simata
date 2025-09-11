<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    // 📌 Ambil semua data unit
    public function index()
    {
        return response()->json([
            'status' => 'sukses',
            'data'   => Unit::all()
        ]);
    }

    // 📌 Tambah unit baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_unit' => 'required|string|max:255',
            'kode_unit' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        $unit = Unit::create($validated);

        return response()->json([
            'status' => 'sukses',
            'pesan'  => 'Unit berhasil ditambahkan',
            'data'   => $unit
        ]);
    }

    // 📌 Detail 1 unit
    public function show($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Unit tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'sukses',
            'data'   => $unit
        ]);
    }

    // 📌 Update unit
    public function update(Request $request, $id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Unit tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama_unit' => 'sometimes|string|max:255',
            'kode_unit' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        $unit->update($validated);

        return response()->json([
            'status' => 'sukses',
            'pesan'  => 'Unit berhasil diperbarui',
            'data'   => $unit
        ]);
    }

    // 📌 Hapus unit
    public function destroy($id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Unit tidak ditemukan'
            ], 404);
        }

        $unit->delete();

        return response()->json([
            'status' => 'sukses',
            'pesan'  => 'Unit berhasil dihapus'
        ]);
    }
}
