<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ijin;
use App\Models\LaporanIjin;

class LaporanIjinController extends Controller
{
    public function generate(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $rekap = Ijin::select('nama', 'unit')
            ->selectRaw("COUNT(*) as total_ijin")
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->groupBy('nama', 'unit')
            ->get();

        foreach ($rekap as $r) {
            LaporanIjin::updateOrCreate(
                [
                    'nama' => $r->nama,
                    'unit' => $r->unit,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ],
                [
                    'total_ijin' => $r->total_ijin,
                ]
            );
        }

        return response()->json([
            'message' => 'Laporan Ijin berhasil direkap',
            'data' => $rekap
        ], 200);
    }

    public function index()
    {
        return response()->json(LaporanIjin::all(), 200);
    }
}
