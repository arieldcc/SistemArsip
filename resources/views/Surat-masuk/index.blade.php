@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="{{ asset('css/style_awal.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Surat Masuk</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">List Surat Masuk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="suratMasukTable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">NO.</th>
                            <th class="text-center">No Surat</th>
                            <th class="text-center">Asal Surat</th>
                            <th class="text-center">Jenis Surat</th>
                            <th class="text-center">Perihal</th>
                            <th class="text-center">Tanggal Surat</th>
                            <th class="text-center">Tanggal Terima</th>
                            <th class="text-center">Tanggal Arsip</th>
                            <th class="text-center">Status Disposisi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $surat)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $surat->no_surat }}</td>
                                <td>{{ $surat->asal_surat }}</td>
                                <td>{{ $surat->jenis_surat }}</td>
                                <td>{{ $surat->perihal_surat }}</td>
                                <td>{{ $surat->tgl_surat }}</td>
                                <td>{{ $surat->tgl_terima }}</td>
                                <td>{{ $surat->tgl_arsip }}</td>
                                <td>{{ $surat->status_disposisi === 'y' ? 'Ya' : 'Tidak' }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info" onclick="showFile('{{ $surat->file_surat_masuk }}')">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <button type="button" class="action-btn btn-tampil" onclick="showDetail('{{ $surat->id }}')" title="Tampil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="/surat-masuk/{{ $surat->id }}/edit" class="action-btn btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="action-btn btn-hapus" onclick="confirmDelete('{{ $surat->id }}')" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form id="delete-form" action="" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    <!-- Include Modal Detail -->
    @include('Surat-masuk.modal_detail')

    <!-- Include Modal untuk Menampilkan File Surat -->
    @include('Surat-masuk.modal_file')

    <!-- Floating Action Button -->
    <a href="/surat-masuk/create" class="fab-btn" title="Tambah Surat Masuk">+</a>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#suratMasukTable').DataTable(); // Tanpa pengaturan `language.url`

            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    timerProgressBar: true
                });
            @endif
        });

        function showDetail(id) {
            $.ajax({
                url: `/surat-masuk/${id}`, // Endpoint untuk mengambil detail surat masuk
                type: 'GET',
                success: function(data) {
                    // Isi data ke dalam elemen modal
                    $('#detailNoSurat').text(data.no_surat);
                    $('#detailAsalSurat').text(data.asal_surat);
                    $('#detailJenisSurat').text(data.jenis_surat);
                    $('#detailPerihalSurat').text(data.perihal_surat);
                    $('#detailTglSurat').text(data.tgl_surat);
                    $('#detailTglTerima').text(data.tgl_terima);
                    $('#detailTglArsip').text(data.tgl_arsip);
                    $('#detailStatusDisposisi').text(data.status_disposisi === 'y' ? 'Ya' : 'Tidak');
                    $('#detailIsiSingkat').text(data.isi_singkat);
                    $('#detailKeterangan').text(data.keterangan);
                    $('#detailFileSurat').attr('href', `/storage/${data.file_surat_masuk}`);

                    // Tampilkan berkas berdasarkan tipe file
                    const fileUrl = `/storage/${data.file_surat_masuk}`;
                    const fileExtension = data.file_surat_masuk.split('.').pop().toLowerCase();

                    if (fileExtension === 'pdf') {
                        // Tampilkan PDF dalam iframe
                        $('#pdfViewer').attr('src', fileUrl).show();
                        $('#imageViewer').hide();
                    } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                        // Tampilkan link untuk mengunduh gambar
                        $('#imageViewer').attr('src', fileUrl).show();
                        $('#pdfViewer').hide();
                    }

                    // Tampilkan detail disposisi jika ada
                    if (data.disposisi) {
                        $('#detailDisposisi').show(); // Tampilkan bagian disposisi
                        $('#disposisiBagian').text(data.disposisi.bagian?.nama_bagian || '-');
                        $('#disposisiSifat').text(data.disposisi.sifat || '-');
                        $('#disposisiIsi').text(data.disposisi.isi_disposisi || '-');
                        $('#disposisiCatatan').text(data.disposisi.catatan || '-');
                    } else {
                        $('#detailDisposisi').hide(); // Sembunyikan bagian disposisi jika tidak ada
                    }

                    // Inisialisasi modal dengan backdrop statis
                    const detailModal = new bootstrap.Modal(document.getElementById('detailModal'), {
                            backdrop: 'static',
                            keyboard: false
                        });
                    detailModal.show();
                },
                error: function() {
                    alert('Gagal memuat data surat masuk.');
                }
            });
        }

        function showFile(filePath) {
            const fileUrl = `/storage/${filePath}`;
            const fileExtension = filePath.split('.').pop().toLowerCase();

            // Reset tampilkan
            $('#pdfViewer1').hide();
            $('#imageViewer1').hide();

            // Tampilkan file sesuai tipe
            if (fileExtension === 'pdf') {
                $('#pdfViewer1').attr('src', fileUrl).show();
                $('#imageViewer1').hide();
            } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                // Tampilkan gambar langsung
                $('#imageViewer1').attr('src', fileUrl).show();
                $('#pdfViewer1').hide();
            }

            // Tampilkan modal
            const fileModal = new bootstrap.Modal(document.getElementById('fileModal'));
            fileModal.show();
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('delete-form');
                    form.action = '/surat-masuk/' + id;
                    form.submit();
                }
            });
        }
    </script>
@endsection
