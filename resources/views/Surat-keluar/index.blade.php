@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="{{ asset('css/style_awal.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Surat Keluar</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">List Surat Keluar</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="suratKeluarTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>No Surat</th>
                            <th>Bagian</th>
                            <th>Tujuan Surat</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $item->no_surat }}</td>
                                <td>{{ $item->bagian->nama_bagian ?? '-' }}</td>
                                <td>{{ $item->tujuan_surat }}</td>
                                <td>{{ $item->jenis_surat }}</td>
                                <td>{{ $item->tgl_surat }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info" onclick="showFile('{{ $item->file_surat_keluar }}')">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <button type="button" class="action-btn btn-tampil" onclick="showDetail('{{ $item->id }}')" title="Tampil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="/surat-keluar/{{ $item->id }}/edit" class="action-btn btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="action-btn btn-hapus" onclick="confirmDelete('{{ $item->id }}')" title="Hapus">
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
    @include('Surat-keluar.modal_detail')

    <!-- Include Modal untuk Menampilkan File Surat -->
    @include('Surat-keluar.modal_file')

    <!-- Floating Action Button -->
    <a href="/surat-keluar/create" class="fab-btn" title="Tambah Surat Keluar">+</a>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#suratKeluarTable').DataTable();

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
                    form.action = '/surat-keluar/' + id;
                    form.submit();
                }
            });
        }

        function showDetail(id) {
            $.ajax({
                url: `/surat-keluar/${id}`, // Endpoint untuk mengambil detail surat keluar
                type: 'GET',
                success: function(data) {
                    // Isi data ke dalam elemen modal
                    $('#detailNoSurat').text(data.no_surat);
                    $('#detailBagian').text(data.bagian.nama_bagian ?? '-');
                    $('#detailTujuanSurat').text(data.tujuan_surat);
                    $('#detailJenisSurat').text(data.jenis_surat);
                    $('#detailTglSurat').text(data.tgl_surat);
                    $('#detailTglTerima').text(data.tgl_terima);
                    $('#detailTglArsip').text(data.tgl_arsip);
                    $('#detailPerihalSurat').text(data.perihal_surat);
                    $('#detailIsiSingkat').text(data.isi_singkat);
                    $('#detailKeterangan').text(data.keterangan);

                    // Tampilkan berkas berdasarkan tipe file
                    const fileUrl = `/storage/${data.file_surat_keluar}`;
                    const fileExtension = data.file_surat_keluar.split('.').pop().toLowerCase();

                    $('#pdfViewer').hide();
                    $('#imageViewer').hide();
                    $('#fileDownloadLink').hide();

                    if (fileExtension === 'pdf') {
                        $('#pdfViewer').attr('src', fileUrl).show();
                    } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                        $('#imageViewer').attr('src', fileUrl).show();
                    }
                    $('#fileDownloadLink').attr('href', fileUrl).show();

                    // Tampilkan modal
                    const detailModal = new bootstrap.Modal(document.getElementById('detailModal'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    detailModal.show();
                },
                error: function() {
                    alert('Gagal memuat data surat keluar.');
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

            // Show the download button for the user to download the file
            $('#downloadBtn').attr('data-file-url', fileUrl).show();

            // Tampilkan modal
            const fileModal = new bootstrap.Modal(document.getElementById('fileModal'));
            fileModal.show();
        }

        // Function to handle file download
        function downloadFile() {
            const fileUrl = $('#downloadBtn').attr('data-file-url');

            // Create an invisible anchor tag to trigger download
            const a = document.createElement('a');
            a.href = fileUrl;
            a.download = fileUrl.split('/').pop(); // Extract filename from URL
            a.click(); // Trigger the download
        }
    </script>
@endsection
