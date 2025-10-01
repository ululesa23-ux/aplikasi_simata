<?php

namespace App\Http\Controllers;

use App\Models\Doa;
use Illuminate\Http\Request;

class DoaController extends Controller
{
    // ================= API =================
    public function index()
    {
        $localDoas = Doa::all();
        return response()->json([
            'local' => $localDoas
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:255',
            'arab'    => 'required|string',
            'latin'   => 'required|string',
            'artinya' => 'required|string',
        ]);

        $doa = Doa::create($validated);

        return response()->json([
            'message' => 'Doa berhasil ditambahkan',
            'data'    => $doa
        ], 201);
    }

    public function show($id)
    {
        $doa = Doa::find($id);

        if (!$doa) {
            return response()->json(['error' => 'Doa tidak ditemukan'], 404);
        }

        return response()->json($doa);
    }

    // ================= WEB (Blade CRUD) =================
    public function indexWeb()
    {
        $localDoas = Doa::all();
        return view('doa.index', ['doas' => $localDoas]);
    }

    public function createWeb()
    {
        return view('doa.create');
    }

    public function storeWeb(Request $request)
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:255',
            'arab'    => 'required|string',
            'latin'   => 'required|string',
            'artinya' => 'required|string',
        ]);

        Doa::create($validated);

        return redirect('/doa')->with('success', 'Doa berhasil ditambahkan!');
    }

    public function editWeb($id)
    {
        $doa = Doa::findOrFail($id);
        return view('doa.edit', compact('doa'));
    }

    public function updateWeb(Request $request, $id)
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:255',
            'arab'    => 'required|string',
            'latin'   => 'required|string',
            'artinya' => 'required|string',
        ]);

        $doa = Doa::findOrFail($id);
        $doa->update($validated);

        return redirect('/doa')->with('success', 'Doa berhasil diperbarui!');
    }

    public function destroyWeb($id)
    {
        $doa = Doa::findOrFail($id);
        $doa->delete();

        return redirect('/doa')->with('success', 'Doa berhasil dihapus!');
    }
}
