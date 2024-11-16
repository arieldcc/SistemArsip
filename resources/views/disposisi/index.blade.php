@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="{{ asset('css/style_awal.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Surat Masuk dengan Disposisi Aktif</h1>
        <!-- Tombol Laporan -->
        <a href="/disposisi/laporan" class="btn btn-success">Unduh Laporan</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">List Data Disposisi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="disposisiTable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Surat</th>
                            <th>Asal Surat</th>
                            <th>Jenis Surat</th>
                            <th>Bagian Disposisi</th>
                            <th>Sifat</th>
                            <th>Isi Disposisi</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->no_surat }}</td>
                                <td>{{ $item->asal_surat }}</td>
                                <td>{{ $item->jenis_surat }}</td>
                                <td>{{ $item->disposisi->bagian->nama_bagian ?? '-' }}</td>
                                <td>{{ $item->disposisi->sifat ?? '-' }}</td>
                                <td>{{ $item->disposisi->isi_disposisi ?? '-' }}</td>
                                <td>{{ $item->disposisi->catatan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#disposisiTable').DataTable();
        });
    </script>
@endsection
