<?php

namespace App\Http\Controllers;

use App\Models\MBagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function index(){
        $data = MBagian::all();

        return view('Bagian.index', compact('data'));
    }

    public function create(){
        return view('Bagian.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_bagian' => 'required|string|max:200'
        ]);

        MBagian::create([
            'nama_bagian' => $request->nama_bagian
        ]);

        return redirect('/bagian')->with('success', 'Data Bagian berhasil ditambahkan!');
    }

    public function show_data($id) {
        $bagian = MBagian::findOrFail($id);
        return response()->json($bagian);
    }

    public function show_edit($id) {
        $bagian = MBagian::findOrFail($id);
        return response()->json($bagian);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_bagian' => 'required|string|max:200',
        ]);

        $bagian = MBagian::findOrFail($id);
        $bagian->update($request->all());

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function delete($id){
        $bagian = MBagian::findOrFail($id);
        $bagian->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
