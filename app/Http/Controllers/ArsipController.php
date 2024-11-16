<?php

namespace App\Http\Controllers;

use App\Models\M_SuratKeluar;
use App\Models\M_SuratMasuk;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index() {
        $suratMasuk = M_SuratMasuk::all();
        $suratKeluar = M_SuratKeluar::all();

        return view('Arsip.index', compact('suratMasuk', 'suratKeluar'));
    }

    public function show_detail($type, $id){
        if ($type == 'masuk') {
            $data = M_SuratMasuk::findOrFail($id);
        } elseif ($type == 'keluar') {
            $data = M_SuratKeluar::findOrFail($id);
        } else {
            abort(404);
        }

        return response()->json($data);
    }
}
