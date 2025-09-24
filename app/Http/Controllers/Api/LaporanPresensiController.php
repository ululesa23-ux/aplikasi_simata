<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\LaporanPresensi;

class LaporanPresensiController extends Controller
{
    public function generate(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $rekap = Presensi::select('nama', 'unit')
            ->selectRaw("SUM(CASE WHEN jenis_presensi = 'datang' THEN 1 ELSE 0 END) as total_hadir")
            ->selectRaw("SUM(CASE WHEN jenis_presensi = 'pulang' THEN 1 ELSE 0 END) as total_pulang")
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->groupBy('nama', 'unit')
            ->get();

        foreach ($rekap as $r) {
            LaporanPresensi::updateOrCreate(
                [
                    'nama' => $r->nama,
                    'unit' => $r->unit,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ],
                [
                    'total_hadir' => $r->total_hadir,
                    'total_pulang' => $r->total_pulang,
                ]
            );
        }

        return response()->json([
            'message' => 'Laporan Presensi berhasil direkap',
            'data' => $rekap
        ], 200);
    }

    public function index()
    {
        return response()->json(LaporanPresensi::all(), 200);
    }
}
