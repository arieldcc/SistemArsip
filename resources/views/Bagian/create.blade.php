@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Bagian</h5>
        </div>
        <div class="card-body">
            <form action="/bagian/store" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_bagian">Nama Bagian</label>
                    <input type="text" class="form-control" id="nama_bagian" name="nama_bagian" required>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <!-- Tombol Simpan dengan Ikon -->
                    <button type="submit" class="btn btn-primary btn-icon mr-2" title="Simpan">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <!-- Tombol Batal dengan Ikon -->
                    <a href="/bagian" class="btn btn-secondary btn-icon" title="Batal">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
