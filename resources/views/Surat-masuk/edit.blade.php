@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Surat Masuk</h5>
        </div>
        <div class="card-body">
            <form action="/surat-masuk/{{ $suratMasuk->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="no_surat">No Surat</label>
                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat', $suratMasuk->no_surat) }}" required>
                    @error('no_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="asal_surat">Asal Surat</label>
                    <input type="text" class="form-control @error('asal_surat') is-invalid @enderror" id="asal_surat" name="asal_surat" value="{{ old('asal_surat', $suratMasuk->asal_surat) }}" required>
                    @error('asal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="isi_singkat">Isi Singkat</label>
                    <textarea class="form-control @error('isi_singkat') is-invalid @enderror" id="isi_singkat" name="isi_singkat" rows="3" required>{{ old('isi_singkat', $suratMasuk->isi_singkat) }}</textarea>
                    @error('isi_singkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_surat">Jenis Surat</label>
                    <input type="text" class="form-control @error('jenis_surat') is-invalid @enderror" id="jenis_surat" name="jenis_surat" value="{{ old('jenis_surat', $suratMasuk->jenis_surat) }}" required>
                    @error('jenis_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="perihal_surat">Perihal Surat</label>
                    <input type="text" class="form-control @error('perihal_surat') is-invalid @enderror" id="perihal_surat" name="perihal_surat" value="{{ old('perihal_surat', $suratMasuk->perihal_surat) }}" required>
                    @error('perihal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_surat">Tanggal Surat</label>
                    <input type="date" class="form-control @error('tgl_surat') is-invalid @enderror" id="tgl_surat" name="tgl_surat" value="{{ old('tgl_surat', $suratMasuk->tgl_surat) }}" required>
                    @error('tgl_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_terima">Tanggal Terima</label>
                    <input type="date" class="form-control @error('tgl_terima') is-invalid @enderror" id="tgl_terima" name="tgl_terima" value="{{ old('tgl_terima', $suratMasuk->tgl_terima) }}" required>
                    @error('tgl_terima')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_arsip">Tanggal Arsip</label>
                    <input type="date" class="form-control @error('tgl_arsip') is-invalid @enderror" id="tgl_arsip" name="tgl_arsip" value="{{ old('tgl_arsip', $suratMasuk->tgl_arsip) }}" required>
                    @error('tgl_arsip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status_disposisi">Status Disposisi</label>
                    <select class="form-control @error('status_disposisi') is-invalid @enderror" id="status_disposisi" name="status_disposisi" required>
                        <option value="" {{ old('status_disposisi') == '' ? 'selected' : '' }} disabled>Disposisi</option>
                        <option value="y" {{ old('status_disposisi', $suratMasuk->status_disposisi) == 'y' ? 'selected' : '' }}>Ya</option>
                        <option value="t" {{ old('status_disposisi', $suratMasuk->status_disposisi) == 't' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('status_disposisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- @if($disposisi) --}}
                <div id="bagian_disposisi_group" class="border p-3 mt-3" style="display: none; border-color: #007bff; border-width: 1px; border-radius: 5px;">
                    <h5 class="text-primary mb-3">Form Disposisi</h5>

                    <div class="form-group">
                        <label for="id_bagian">Bagian Disposisi</label>
                        <select class="form-control" id="id_bagian" name="id_bagian">
                            <option value="" disabled {{ old('id_bagian', optional($disposisi)->id_bagian) === null ? 'selected' : '' }}>Pilih Bagian</option>
                            @foreach ($bagian as $item)
                                <option value="{{ $item->id }}" {{ old('id_bagian', optional($disposisi)->id_bagian) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_bagian }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="isi_disposisi">Isi Disposisi</label>
                        <textarea class="form-control" id="isi_disposisi" name="isi_disposisi" rows="3">{{ old('isi_disposisi', optional($disposisi)->isi_disposisi) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="sifat">Sifat</label>
                        <select class="form-control" id="sifat" name="sifat">
                            <option value="" disabled {{ old('sifat', optional($disposisi)->sifat) === null ? 'selected' : '' }}>Pilih Sifat</option>
                            <option value="rahasia" {{ old('sifat', optional($disposisi)->sifat) == 'rahasia' ? 'selected' : '' }}>Rahasia</option>
                            <option value="penting" {{ old('sifat', optional($disposisi)->sifat) == 'penting' ? 'selected' : '' }}>Penting</option>
                            <option value="biasa" {{ old('sifat', optional($disposisi)->sifat) == 'biasa' ? 'selected' : '' }}>Biasa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan', optional($disposisi)->catatan) }}</textarea>
                    </div>
                </div>
                {{-- @endif --}}

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $suratMasuk->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file_surat">File Surat (PDF atau Gambar, max: 600KB)</label>
                    <input type="hidden" name="oldfile_surat" value="{{ $suratMasuk->file_surat_masuk }}">
                    <input type="file" class="form-control @error('file_surat') is-invalid @enderror" id="file_surat" name="file_surat" accept=".pdf, image/*">

                    <small class="d-block mt-2">File saat ini:</small>

                    @if ($suratMasuk->file_surat_masuk)
                        @php
                            $fileExtension = pathinfo($suratMasuk->file_surat_masuk, PATHINFO_EXTENSION);
                        @endphp

                        <!-- Tampilkan file PDF menggunakan iframe -->
                        @if ($fileExtension === 'pdf')
                            <iframe src="{{ asset('storage/' . $suratMasuk->file_surat_masuk) }}" width="100%" height="500px"></iframe>
                        @endif

                        <!-- Tampilkan gambar langsung -->
                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('storage/' . $suratMasuk->file_surat_masuk) }}" alt="File Surat" style="width: 100%; max-height: 500px; object-fit: contain;" class="mt-2">
                        @endif

                        <!-- Link unduhan untuk semua jenis file -->
                        <p><a href="{{ asset('storage/' . $suratMasuk->file_surat_masuk) }}" target="_blank">Unduh File</a></p>
                    @else
                        <p class="text-muted">Tidak ada file yang diunggah.</p>
                    @endif

                    @error('file_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
            if (bagianDisposisiGroup) { // Pastikan elemen ada sebelum mengaksesnya
                if (statusDisposisi.value === 'y') {
                    bagianDisposisiGroup.style.display = 'block';
                } else {
                    bagianDisposisiGroup.style.display = 'none';
                }
            }
        }

        // Jalankan saat halaman dimuat (untuk mengatur state awal)
        toggleBagianDisposisi();

        // Tambahkan event listener untuk menampilkan/menghilangkan dropdown
        statusDisposisi.addEventListener('change', toggleBagianDisposisi);
    });
</script>
@endsection
