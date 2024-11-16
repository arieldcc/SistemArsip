<?php

namespace App\Http\Controllers;

use App\Models\M_Disposisi;
use App\Models\M_SuratKeluar;
use App\Models\M_SuratMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // Total data
        $totalSuratMasuk = M_SuratMasuk::count();
        $totalSuratKeluar = M_SuratKeluar::count();
        $totalDisposisi = M_Disposisi::count();
        $totalArsip = $totalSuratMasuk + $totalSuratKeluar;

        // Statistik bulanan surat masuk
        $suratMasukBulanan = M_SuratMasuk::selectRaw("MONTH(tgl_surat) as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month')
            ->map(function ($item) {
                return $item->count;
            })
            ->toArray();

        // Statistik bulanan surat keluar
        $suratKeluarBulanan = M_SuratKeluar::selectRaw("MONTH(tgl_surat) as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month')
            ->map(function ($item) {
                return $item->count;
            })
            ->toArray();

        // Labels dan Values
        $labels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $valuesSuratMasuk = [];
        $valuesSuratKeluar = [];

        foreach (range(1, 12) as $month) {
            $valuesSuratMasuk[] = $suratMasukBulanan[$month] ?? 0;
            $valuesSuratKeluar[] = $suratKeluarBulanan[$month] ?? 0;
        }

        return view('dashboard.index', [
            'totalSuratMasuk' => $totalSuratMasuk,
            'totalSuratKeluar' => $totalSuratKeluar,
            'totalDisposisi' => $totalDisposisi,
            'totalArsip' => $totalArsip,
            'data' => [
                'labels' => $labels,
                'valuesSuratMasuk' => $valuesSuratMasuk,
                'valuesSuratKeluar' => $valuesSuratKeluar,
            ]
        ]);
    }
}
