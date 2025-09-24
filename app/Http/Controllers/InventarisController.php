<?php


namespace App\Http\Controllers;


use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class InventarisController extends Controller
{
public function index(Request $request)
{
$q = $request->query('q');
$query = Inventaris::query();


if ($q) {
$query->where('nama', 'like', "%{$q}%")
->orWhere('kode', 'like', "%{$q}%");
}


$inventaris = $query->orderBy('created_at', 'desc')
->paginate(10)
->withQueryString();


return view('inventaris.index', compact('inventaris', 'q'));
}


public function create()
{
return view('inventaris.create');
}


public function store(Request $request)
{
$data = $request->validate([
'kode' => 'required|unique:inventaris,kode',
'nama' => 'required|string',
'deskripsi' => 'nullable|string',
'jumlah' => 'required|integer|min:0',
'kondisi' => 'required|string',
'lokasi' => 'nullable|string',
'tanggal_masuk' => 'nullable|date',
'foto' => 'nullable|image|max:2048',
]);


if ($request->hasFile('foto')) {
$path = $request->file('foto')->store('inventaris', 'public');
$data['foto'] = $path;
}


Inventaris::create($data);


return redirect()->route('inventaris.index')->with('success', 'Barang berhasil ditambahkan.');
}


}