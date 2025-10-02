<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KalenderAkademikController extends Controller
{
    // ================== API (JSON) ==================

    public function index()
    {
        return response()->json([
            'status' => 'sukses',
            'data'   => KalenderAkademik::with('unit')->get()
        ]);
    }

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

    // ================== WEB (Blade) ==================

    public function indexWeb()
    {
        $kalenders = KalenderAkademik::with('unit')->latest()->get();
        return view('kalender.index', compact('kalenders'));
    }

    public function createWeb()
    {
        $units = Unit::all();
        return view('kalender.create', compact('units'));
    }

    public function storeWeb(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jenis'           => 'nullable|string|max:50',
            'keterangan'      => 'nullable|string',
            'unit_id'         => 'required|exists:units,id',
        ]);

        KalenderAkademik::create($request->all());

        return redirect()->route('kalender.index')->with('success', 'Kalender berhasil ditambahkan!');
    }

    public function editWeb($id)
    {
        $kalender = KalenderAkademik::findOrFail($id);
        $units = Unit::all();
        return view('kalender.edit', compact('kalender', 'units'));
    }

    public function updateWeb(Request $request, $id)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jenis'           => 'nullable|string|max:50',
            'keterangan'      => 'nullable|string',
            'unit_id'         => 'required|exists:units,id',
        ]);

        $kalender = KalenderAkademik::findOrFail($id);
        $kalender->update($request->all());

        return redirect()->route('kalender.index')->with('success', 'Kalender berhasil diperbarui!');
    }

    public function destroyWeb($id)
    {
        $kalender = KalenderAkademik::findOrFail($id);
        $kalender->delete();

        return redirect()->route('kalender.index')->with('success', 'Kalender berhasil dihapus!');
    }
}
