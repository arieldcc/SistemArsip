<!-- resources/views/content.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="my-4">Daftar Arsip Surat</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Jenis Surat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>001/ARSIP/2024</td>
                    <td>2024-01-01</td>
                    <td>Surat Masuk</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Lihat</a>
                        <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <!-- Tambahkan data lainnya di sini -->
            </tbody>
        </table>
    </div>
</div>
@endsection
