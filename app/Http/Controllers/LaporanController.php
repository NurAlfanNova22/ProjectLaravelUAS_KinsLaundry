<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil data pesanan dalam bulan ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $pesanans = Pesanan::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->get();

        $totalPendapatan = $pesanans->sum('total_harga');

        return view('admin.laporan', compact('pesanans', 'totalPendapatan'));
    }

    public function print()
    {
        // Mengambil data pesanan dalam bulan ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $pesanans = Pesanan::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->get();

        $totalPendapatan = $pesanans->sum('total_harga');

        return view('admin.laporan_print', compact('pesanans', 'totalPendapatan'));
    }
}
