<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\LaporanPresensi;
use App\Models\LaporanIjin;

class RekapanController extends Controller

{
    // daftar unit untuk dipilih
    public function index()
    {
        $units = Unit::all();
        return view('rekapan.index', compact('units'));
    }

    // detail rekap presensi + ijin
    public function show($unit_id, Request $request)
    {
        $bulan = $request->query('bulan') ?? date('m');
        $tahun = $request->query('tahun') ?? date('Y');

        $unit = Unit::findOrFail($unit_id);

        $presensi = LaporanPresensi::where('unit', $unit->nama_unit)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get();

        $ijin = LaporanIjin::where('unit', $unit->nama_unit)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get();

        return view('rekapan.show', compact('unit', 'bulan', 'tahun', 'presensi', 'ijin'));
    }
}
