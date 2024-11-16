<?php

namespace App\Http\Controllers;

use App\Models\M_Disposisi;
use App\Models\M_SuratKeluar;
use App\Models\M_SuratMasuk;
use App\Models\MBagian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        $bagian = MBagian::all();
        $suratMasuk = M_SuratMasuk::all();
        $disposisi = M_Disposisi::all();
        $suratKeluar = M_SuratKeluar::all();
        return view('Laporan.index', compact('bagian', 'suratMasuk', 'disposisi', 'suratKeluar'));
    }

    public function laporanBagian() {
        $bagian = MBagian::all();
        return view('Laporan.bagian', compact('bagian'));
    }

    public function laporanSuratMasuk() {
        $suratMasuk = M_SuratMasuk::all();
        return view('Laporan.surat_masuk', compact('suratMasuk'));
    }

    public function laporanDisposisi(){
        $disposisi = M_Disposisi::all();
        return view('Laporan.disposisi', compact('disposisi'));
    }

    public function laporanSuratKeluar() {
        $suratKeluar = M_SuratKeluar::all();
        return view('Laporan.surat_keluar', compact('suratKeluar'));
    }
}
