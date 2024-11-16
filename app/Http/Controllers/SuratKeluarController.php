<?php

namespace App\Http\Controllers;

use App\Models\M_SuratKeluar;
use App\Models\MBagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index() {
        $data = M_SuratKeluar::with('bagian')->get();

        return view('Surat-keluar.index', compact('data'));
    }

    public function create() {
        $bagian = MBagian::all();
        return view('Surat-keluar.create', compact('bagian'));
    }

    public function store(Request $request){
        $request->validate([
            'no_surat' => 'required|string|max:25|unique:t_surat_keluar,no_surat',
            'id_bagian' => 'required|uuid',
            'tujuan_surat' => 'required|string|max:200',
            'isi_singkat' => 'required|string|max:200',
            'jenis_surat' => 'required|string|max:100',
            'perihal_surat' => 'required|string|max:200',
            'tgl_surat' => 'required|date',
            'tgl_terima' => 'required|date',
            'tgl_arsip' => 'required|date',
            'keterangan' => 'nullable|string',
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:600',
        ]);

        // Proses upload file jika ada
        if ($request->hasFile('file_surat_keluar')) {
            $file = $request->file('file_surat_keluar');
            $filePath = $file->store('uploads/surat_keluar', 'public'); // Simpan di folder public/uploads/surat_keluar
        }

        M_SuratKeluar::create([
            'no_surat' => $request->no_surat,
            'id_bagian' => $request->id_bagian,
            'tujuan_surat' => $request->tujuan_surat,
            'isi_singkat' => $request->isi_singkat,
            'jenis_surat' => $request->jenis_surat,
            'perihal_surat' => $request->perihal_surat,
            'tgl_surat' => $request->tgl_surat,
            'tgl_terima' => $request->tgl_terima,
            'tgl_arsip' => $request->tgl_arsip,
            'keterangan' => $request->keterangan,
            'file_surat_keluar' => $filePath ?? null,
        ]);

        return redirect('/surat-keluar')->with('success', 'Data Surat Keluar berhasil disimpan!');
    }

    public function show_data($id) {
        $data = M_SuratKeluar::with('bagian')->findOrFail($id);
        return response()->json($data);
    }

    public function show_edit($id) {
        $suratKeluar = M_SuratKeluar::findOrFail($id);
        $bagian = MBagian::all();
        return view('Surat-keluar.edit', compact('suratKeluar', 'bagian'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'no_surat' => 'required|string|max:25|unique:t_surat_keluar,no_surat,' . $id,
            'id_bagian' => 'required|uuid',
            'tujuan_surat' => 'required|string|max:200',
            'isi_singkat' => 'required|string|max:200',
            'jenis_surat' => 'required|string|max:100',
            'perihal_surat' => 'required|string|max:200',
            'tgl_surat' => 'required|date',
            'tgl_terima' => 'required|date',
            'tgl_arsip' => 'required|date',
            'keterangan' => 'nullable|string',
            'file_surat_keluar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:600',
        ]);

        $suratKeluar = M_SuratKeluar::findOrFail($id);

        if ($request->hasFile('file_surat_keluar')) {
            if ($suratKeluar->file_surat_keluar && Storage::disk('public')->exists($suratKeluar->file_surat_keluar)) {
                Storage::disk('public')->delete($suratKeluar->file_surat_keluar);
            }

            $filePath = $request->file('file_surat_keluar')->store('uploads/surat_keluar', 'public');
            $suratKeluar->file_surat_keluar = $filePath;
        }

        $suratKeluar->update($request->except('file_surat_keluar'));

        return redirect('/surat-keluar')->with('success', 'Data Surat keluar berhasil diperbarui!');
    }

    public function delete($id) {
        $suratKeluar = M_SuratKeluar::findOrFail($id);

        // Hapus file terkait jika ada
        if ($suratKeluar->file_surat_keluar && Storage::disk('public')->exists($suratKeluar->file_surat_keluar)) {
            Storage::disk('public')->delete($suratKeluar->file_surat_keluar);
        }

        // Hapus data dari database
        $suratKeluar->delete();

        return redirect('/surat-keluar')->with('success', 'Data Surat Keluar berhasil dihapus!');
    }
}
