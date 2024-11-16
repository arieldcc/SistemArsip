@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Surat Masuk</h5>
        </div>
        <div class="card-body">
            <form action="/surat-masuk/store" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="no_surat">No Surat</label>
                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat') }}" required>
                    @error('no_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="asal_surat">Asal Surat</label>
                    <input type="text" class="form-control @error('asal_surat') is-invalid @enderror" id="asal_surat" name="asal_surat" value="{{ old('asal_surat') }}" required>
                    @error('asal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="isi_singkat">Isi Singkat</label>
                    <textarea class="form-control @error('isi_singkat') is-invalid @enderror" id="isi_singkat" name="isi_singkat" rows="3" required>{{ old('isi_singkat') }}</textarea>
                    @error('isi_singkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_surat">Jenis Surat</label>
                    <input type="text" class="form-control @error('jenis_surat') is-invalid @enderror" id="jenis_surat" name="jenis_surat" value="{{ old('jenis_surat') }}" required>
                    @error('jenis_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="perihal_surat">Perihal Surat</label>
                    <input type="text" class="form-control @error('perihal_surat') is-invalid @enderror" id="perihal_surat" name="perihal_surat" value="{{ old('perihal_surat') }}" required>
                    @error('perihal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_surat">Tanggal Surat</label>
                    <input type="date" class="form-control @error('tgl_surat') is-invalid @enderror" id="tgl_surat" name="tgl_surat" value="{{ old('tgl_surat') }}" required>
                    @error('tgl_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_terima">Tanggal Terima</label>
                    <input type="date" class="form-control @error('tgl_terima') is-invalid @enderror" id="tgl_terima" name="tgl_terima" value="{{ old('tgl_terima') }}" required>
                    @error('tgl_terima')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_arsip">Tanggal Arsip</label>
                    <input type="date" class="form-control @error('tgl_arsip') is-invalid @enderror" id="tgl_arsip" name="tgl_arsip" value="{{ old('tgl_arsip') }}" required>
                    @error('tgl_arsip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status_disposisi">Status Disposisi</label>
                    <select class="form-control @error('status_disposisi') is-invalid @enderror" id="status_disposisi" name="status_disposisi" required>
                        <option value="" {{ old('status_disposisi') == '' ? 'selected' : '' }}>Disposisi</option>
                        <option value="y" {{ old('status_disposisi') == 'y' ? 'selected' : '' }}>Ya</option>
                        <option value="t" {{ old('status_disposisi') == 't' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('status_disposisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dropdown untuk memilih Bagian Disposisi, tampil hanya jika Status Disposisi adalah "Ya" -->
                <div id="bagian_disposisi_group" class="border p-3 mt-3" style="display: none; border-color: #007bff; border-width: 1px; border-radius: 5px;">
                    <h5 class="text-primary mb-3">Form Disposisi</h5>
                    <label for="id_bagian">Bagian Disposisi</label>
                    <select class="form-control @error('id_bagian') is-invalid @enderror" id="id_bagian" name="id_bagian">
                        <option value="" {{ old('id_bagian') == '' ? 'selected' : '' }}>Pilih Bagian</option>
                        @foreach ($bagian as $item)
                            <option value="{{ $item->id }}" {{ old('id_bagian') ==  $item->id ? 'selected' : '' }}>{{ $item->nama_bagian }}</option>
                        @endforeach
                    </select>
                    @error('bagian_disposisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="isi_disposisi">Isi Disposisi</label>
                        <textarea class="form-control @error('isi_disposisi') is-invalid @enderror" id="isi_disposisi" name="isi_disposisi" rows="3">{{ old('isi_disposisi') }}</textarea>
                        @error('isi_disposisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sifat">Sifat Disposisi</label>
                        <select class="form-control @error('sifat') is-invalid @enderror" id="sifat" name="sifat">
                            <option value="" {{ old('sifat') == '' ? 'selected' : '' }}>Pilih Sifat</option>
                            <option value="rahasia" {{ old('sifat') == 'rahasia' ? 'selected' : '' }}>Rahasia</option>
                            <option value="penting" {{ old('sifat') == 'penting' ? 'selected' : '' }}>Penting</option>
                            <option value="biasa" {{ old('sifat') == 'biasa' ? 'selected' : '' }}>Biasa</option>
                        </select>
                        @error('sifat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan Disposisi</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file_surat">File Surat (PDF atau Gambar, max: 600KB)</label>
                    <input type="file" class="form-control @error('file_surat') is-invalid @enderror" id="file_surat" name="file_surat" accept=".pdf, image/*">
                    @error('file_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/surat-masuk" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusDisposisi = document.getElementById('status_disposisi');
        const bagianDisposisiGroup = document.getElementById('bagian_disposisi_group');

        function toggleBagianDisposisi() {
            if (statusDisposisi.value === 'y') {
                bagianDisposisiGroup.style.display = 'block';
            } else {
                bagianDisposisiGroup.style.display = 'none';
            }
        }

        // Jalankan saat halaman dimuat (untuk mengatur state awal)
        toggleBagianDisposisi();

        // Tambahkan event listener untuk menampilkan/menghilangkan dropdown
        statusDisposisi.addEventListener('change', toggleBagianDisposisi);
    });
</script>
@endsection

