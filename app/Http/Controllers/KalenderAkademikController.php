<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KalenderAkademikController extends Controller
{
    // 📌 Ambil semua data
    public function index()
    {
        return response()->json([
            'status' => 'sukses',
            'data'   => KalenderAkademik::with('unit')->get()
        ]);
    }

    // 📌 Tambah data baru
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'judul'           => 'required|string|max:255',
                'tanggal_mulai'   => 'required|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
                'jenis'           => 'nullable|string|max:50',
                'keterangan'      => 'nullable|string',
                'unit_id'         => 'required|exists:units,id',
            ], [
                'judul.required' => 'Judul wajib diisi.',
                'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
                'unit_id.required' => 'Unit wajib diisi.',
                'unit_id.exists' => 'Unit tidak ditemukan di database.'
            ]);

            $kalender = KalenderAkademik::create($validated);

            return response()->json([
                'status' => 'sukses',
                'pesan'  => 'Data berhasil ditambahkan',
                'data'   => $kalender
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
    }

    // 📌 Detail 1 data
    public function show($id)
    {
        $kalender = KalenderAkademik::with('unit')->find($id);

        if (!$kalender) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'sukses',
            'data'   => $kalender
        ]);
    }

    // 📌 Update data
    public function update(Request $request, $id)
    {
        $kalender = KalenderAkademik::find($id);

        if (!$kalender) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Data tidak ditemukan'
            ], 404);
        }

        try {
            $validated = $request->validate([
                'judul'           => 'sometimes|string|max:255',
                'tanggal_mulai'   => 'sometimes|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
                'jenis'           => 'nullable|string|max:50',
                'keterangan'      => 'nullable|string',
                'unit_id'         => 'sometimes|exists:units,id',
            ]);

            $kalender->update($validated);

            return response()->json([
                'status' => 'sukses',
                'pesan'  => 'Data berhasil diperbarui',
                'data'   => $kalender
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
    }

    // 📌 Hapus data
    public function destroy($id)
    {
        $kalender = KalenderAkademik::find($id);

        if (!$kalender) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Data tidak ditemukan'
            ], 404);
        }

        $kalender->delete();

        return response()->json([
            'status' => 'sukses',
            'pesan'  => 'Data berhasil dihapus'
        ]);
    }
}
