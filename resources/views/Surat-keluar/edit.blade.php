@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Surat Keluar</h5>
        </div>
        <div class="card-body">
            <form action="/surat-keluar/{{ $suratKeluar->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="no_surat">No Surat</label>
                    <input type="text" class="form-control @error('no_surat') is-invalid @enderror" id="no_surat" name="no_surat" value="{{ old('no_surat', $suratKeluar->no_surat) }}" required>
                    @error('no_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_bagian">Bagian</label>
                    <select class="form-control @error('id_bagian') is-invalid @enderror" id="id_bagian" name="id_bagian" required>
                        <option value="" disabled>Pilih Bagian</option>
                        @foreach ($bagian as $item)
                            <option value="{{ $item->id }}" {{ old('id_bagian', $suratKeluar->id_bagian) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_bagian }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_bagian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tujuan_surat">Tujuan Surat</label>
                    <input type="text" class="form-control @error('tujuan_surat') is-invalid @enderror" id="tujuan_surat" name="tujuan_surat" value="{{ old('tujuan_surat', $suratKeluar->tujuan_surat) }}" required>
                    @error('tujuan_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="isi_singkat">Isi Singkat</label>
                    <textarea class="form-control @error('isi_singkat') is-invalid @enderror" id="isi_singkat" name="isi_singkat" rows="3" required>{{ old('isi_singkat', $suratKeluar->isi_singkat) }}</textarea>
                    @error('isi_singkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_surat">Jenis Surat</label>
                    <input type="text" class="form-control @error('jenis_surat') is-invalid @enderror" id="jenis_surat" name="jenis_surat" value="{{ old('jenis_surat', $suratKeluar->jenis_surat) }}" required>
                    @error('jenis_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="perihal_surat">Perihal Surat</label>
                    <input type="text" class="form-control @error('perihal_surat') is-invalid @enderror" id="perihal_surat" name="perihal_surat" value="{{ old('perihal_surat', $suratKeluar->perihal_surat) }}" required>
                    @error('perihal_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_surat">Tanggal Surat</label>
                    <input type="date" class="form-control @error('tgl_surat') is-invalid @enderror" id="tgl_surat" name="tgl_surat" value="{{ old('tgl_surat', $suratKeluar->tgl_surat) }}" required>
                    @error('tgl_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_terima">Tanggal Terima</label>
                    <input type="date" class="form-control @error('tgl_terima') is-invalid @enderror" id="tgl_terima" name="tgl_terima" value="{{ old('tgl_terima', $suratKeluar->tgl_terima) }}" required>
                    @error('tgl_terima')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_arsip">Tanggal Arsip</label>
                    <input type="date" class="form-control @error('tgl_arsip') is-invalid @enderror" id="tgl_arsip" name="tgl_arsip" value="{{ old('tgl_arsip', $suratKeluar->tgl_arsip) }}" required>
                    @error('tgl_arsip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $suratKeluar->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file_surat_keluar">File Surat (PDF atau Gambar, max: 600KB)</label>
                    <input type="hidden" name="oldfile_surat_keluar" value="{{ $suratKeluar->file_surat_keluar }}">
                    <input type="file" class="form-control @error('file_surat_keluar') is-invalid @enderror" id="file_surat_keluar" name="file_surat_keluar" accept=".pdf, image/*">

                    <small class="d-block mt-2">File saat ini:</small>

                    @if ($suratKeluar->file_surat_keluar)
                        @php
                            $fileExtension = pathinfo($suratKeluar->file_surat_keluar, PATHINFO_EXTENSION);
                        @endphp

                        @if ($fileExtension === 'pdf')
                            <iframe src="{{ asset('storage/' . $suratKeluar->file_surat_keluar) }}" width="100%" height="400px"></iframe>
                        @else
                            <img src="{{ asset('storage/' . $suratKeluar->file_surat_keluar) }}" alt="File Surat" style="width: 100%; max-height: 400px; object-fit: contain;">
                        @endif
                        <p><a href="{{ asset('storage/' . $suratKeluar->file_surat_keluar) }}" target="_blank">Unduh File</a></p>
                    @else
                        <p class="text-muted">Tidak ada file yang diunggah.</p>
                    @endif

                    @error('file_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="/surat-keluar" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
