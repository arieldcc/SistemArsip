<?php

namespace App\Http\Controllers;

use App\Models\M_Disposisi;
use App\Models\M_SuratMasuk;
use App\Models\MBagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratmasukController extends Controller
{
    public function index(){
        $data = M_SuratMasuk::all();

        return view('Surat-masuk.index', compact('data'));
    }

    public function create() {
        $bagian = MBagian::all();
        return view('surat-masuk.create', compact('bagian'));
    }

    public function store(Request $request) {
        $request->validate([
            'no_surat' => 'required|string|max:25|unique:t_surat_masuk,no_surat',
            'asal_surat' => 'required|string|max:100',
            'isi_singkat' => 'required|string',
            'jenis_surat' => 'required|string|max:100',
            'perihal_surat' => 'required|string|max:200',
            'tgl_surat' => 'required|date',
            'tgl_terima' => 'required|date',
            'tgl_arsip' => 'required|date',
            'status_disposisi' => 'required|in:y,t',
            'keterangan' => 'nullable|string',
            'file_surat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:600' // Validasi file surat
        ], [
            'no_surat.unique' => 'No Surat ini sudah ada di sistem. Silakan gunakan nomor lain.',
            'file_surat.max' => 'Ukuran file maksimal adalah 600KB.',
            'file_surat.mimes' => 'File harus berformat PDF atau gambar (JPG, JPEG, PNG).'
        ]);

        // Tambahkan validasi khusus untuk form Disposisi jika status_disposisi adalah 'y'
        if ($request->status_disposisi === 'y') {
            $request->validate([
                'id_bagian' => 'required|string|max:100',
                'isi_disposisi' => 'required|string',
                'sifat' => 'required|in:rahasia,penting,biasa',
                'catatan' => 'nullable|string|max:255',
            ], [
                'id_bagian.required' => 'Bagian Disposisi harus diisi jika status disposisi adalah "Ya".',
                'isi_disposisi.required' => 'Isi Disposisi harus diisi jika status disposisi adalah "Ya".',
                'sifat.required' => 'Sifat Disposisi harus dipilih jika status disposisi adalah "Ya".',
            ]);
        }

        // Proses unggah file surat jika ada
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filePath = $file->store('uploads/surat_masuk', 'public'); // Simpan di folder public/uploads/surat_masuk
        }

        $suratMasuk = M_SuratMasuk::create([
            'no_surat' => $request->no_surat,
            'asal_surat' => $request->asal_surat,
            'isi_singkat' => $request->isi_singkat,
            'jenis_surat' => $request->jenis_surat,
            'perihal_surat' => $request->perihal_surat,
            'tgl_surat' => $request->tgl_surat,
            'tgl_terima' => $request->tgl_terima,
            'tgl_arsip' => $request->tgl_arsip,
            'status_disposisi' => $request->status_disposisi,
            'keterangan' => $request->keterangan,
            'file_surat_masuk' => $filePath ?? null, // Simpan path file jika ada
        ]);

        // Simpan data Disposisi jika status_disposisi adalah 'y'
        if ($request->status_disposisi === 'y') {
            M_Disposisi::create([
                'id_surat_masuk' => $suratMasuk->id, // Ambil ID dari Surat Masuk yang baru saja disimpan
                'id_bagian' => $request->id_bagian,
                'isi_disposisi' => $request->isi_disposisi,
                'sifat' => $request->sifat,
                'catatan' => $request->catatan,
            ]);
        }

        return redirect('/surat-masuk')->with('success', 'Data Bagian berhasil ditambahkan!');
    }

    public function show_data($id) {
        // $data = M_SuratMasuk::findOrFail($id);
        $data = M_SuratMasuk::with('disposisi.bagian') // Ambil disposisi dan bagian
        ->findOrFail($id);
        return response()->json($data);
    }

    public function show_edit($id){
        $suratMasuk = M_SuratMasuk::findOrFail($id);

        $bagian = MBagian::all();

        // Cari data Disposisi berdasarkan id_surat_masuk
        $disposisi = M_Disposisi::where('id_surat_masuk', $id)->first();

        return view('Surat-masuk.edit', compact('suratMasuk', 'bagian', 'disposisi'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_surat' => 'required|string|max:25|unique:t_surat_masuk,no_surat,' . $id,
            'asal_surat' => 'required|string|max:100',
            'isi_singkat' => 'required|string',
            'jenis_surat' => 'required|string|max:100',
            'perihal_surat' => 'required|string|max:200',
            'tgl_surat' => 'required|date',
            'tgl_terima' => 'required|date',
            'tgl_arsip' => 'required|date',
            'status_disposisi' => 'required|in:y,t',
            'keterangan' => 'nullable|string',
            'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:600',
        ]);

        $suratMasuk = M_SuratMasuk::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            if ($suratMasuk->file_surat_masuk && Storage::disk('public')->exists($suratMasuk->file_surat_masuk)) {
                Storage::disk('public')->delete($suratMasuk->file_surat_masuk);
            }
            $file = $request->file('file_surat');
            $filePath = $file->store('uploads/surat_masuk', 'public');
            $suratMasuk->file_surat_masuk = $filePath;
        }

        $suratMasuk->update($request->except(['file_surat']));

        // Jika status_disposisi adalah 'y', lakukan validasi tambahan dan simpan/ubah data disposisi
        if ($request->status_disposisi === 'y') {
            $request->validate([
                'id_bagian' => 'required|exists:t_bagian,id',
                'isi_disposisi' => 'required|string',
                'sifat' => 'required|in:rahasia,penting,biasa',
                'catatan' => 'nullable|string|max:255',
            ]);

            // Cari data disposisi berdasarkan id_surat_masuk
            $disposisi = M_Disposisi::where('id_surat_masuk', $id)->first();

            if ($disposisi) {
                // Perbarui data disposisi jika sudah ada
                $disposisi->update([
                    'id_bagian' => $request->id_bagian,
                    'isi_disposisi' => $request->isi_disposisi,
                    'sifat' => $request->sifat,
                    'catatan' => $request->catatan,
                ]);
            } else {
                // Simpan data disposisi baru jika belum ada
                M_Disposisi::create([
                    'id_surat_masuk' => $id,
                    'id_bagian' => $request->id_bagian,
                    'isi_disposisi' => $request->isi_disposisi,
                    'sifat' => $request->sifat,
                    'catatan' => $request->catatan,
                ]);
            }
        } elseif ($request->status_disposisi === 't') {
            // Jika status_disposisi adalah 't', hapus data disposisi jika ada
            $disposisi = M_Disposisi::where('id_surat_masuk', $id)->first();
            if ($disposisi) {
                $disposisi->delete();
            }
        }

        return redirect('/surat-masuk')->with('success', 'Data Surat Masuk berhasil diperbarui!');
    }

    public function delete($id) {
        $suratMasuk = M_SuratMasuk::findOrFail($id);

        // Hapus data Disposisi terkait jika ada
        $disposisi = M_Disposisi::where('id_surat_masuk', $id);
        if ($disposisi->exists()) {
            $disposisi->delete();
        }

        // Hapus file terkait jika ada
        if ($suratMasuk->file_surat_masuk && Storage::disk('public')->exists($suratMasuk->file_surat_masuk)) {
            Storage::disk('public')->delete($suratMasuk->file_surat_masuk);
        }

        // Hapus data dari database
        $suratMasuk->delete();

        return redirect('/surat-masuk')->with('success', 'Data Surat Masuk berhasil dihapus!');
    }

}
