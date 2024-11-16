<?php

namespace App\Http\Controllers;

use App\Exports\DisposisiExport;
use App\Models\M_SuratMasuk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DisposisiControler extends Controller
{
    public function index(){
        $data = M_SuratMasuk::with('disposisi.bagian') // Ambil disposisi dan bagian
        ->where('status_disposisi', 'y') // Filter hanya status_disposisi = 'y'
        ->get();

        return view('disposisi.index', compact('data'));
    }

    public function report() {
        return Excel::download(new DisposisiExport, 'laporan_disposisi.xlsx');
    }
}
