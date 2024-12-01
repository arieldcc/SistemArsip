@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="{{ asset('css/style_awal.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Arsip Surat</h1>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="arsipTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="suratMasuk-tab" data-toggle="tab" href="#suratMasuk" role="tab" aria-controls="suratMasuk" aria-selected="true">Surat Masuk</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="suratKeluar-tab" data-toggle="tab" href="#suratKeluar" role="tab" aria-controls="suratKeluar" aria-selected="false">Surat Keluar</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="arsipTabContent">
        <!-- Surat Masuk Tab -->
        <div class="tab-pane fade show active" id="suratMasuk" role="tabpanel" aria-labelledby="suratMasuk-tab">
            <div class="table-responsive mt-4">
                <table id="suratMasukTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Asal Surat</th>
                            <th>Isi Singkat</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Tanggal Terima</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suratMasuk as $item)
                            <tr>
                                <td>{{ $item->no_surat }}</td>
                                <td>{{ $item->asal_surat }}</td>
                                <td>{{ $item->isi_singkat }}</td>
                                <td>{{ $item->jenis_surat }}</td>
                                <td>{{ $item->tgl_surat }}</td>
                                <td>{{ $item->tgl_terima }}</td>
                                <td>
                                    @if($item->file_surat_masuk)
                                        <button type="button" class="btn btn-info" onclick="showFile('{{ $item->file_surat_masuk }}')">
                                            <i class="fas fa-file-alt"></i>
                                        </button>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="action-btn btn-tampil" onclick="showDetail('{{ $item->id }}', 'masuk')" title="Tampil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Surat Keluar Tab -->
        <div class="tab-pane fade" id="suratKeluar" role="tabpanel" aria-labelledby="suratKeluar-tab">
            <div class="table-responsive mt-4">
                <table id="suratKeluarTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Tujuan Surat</th>
                            <th>Isi Singkat</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Tanggal Arsip</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suratKeluar as $item)
                            <tr>
                                <td>{{ $item->no_surat }}</td>
                                <td>{{ $item->tujuan_surat }}</td>
                                <td>{{ $item->isi_singkat }}</td>
                                <td>{{ $item->jenis_surat }}</td>
                                <td>{{ $item->tgl_surat }}</td>
                                <td>{{ $item->tgl_arsip }}</td>
                                <td>
                                    @if($item->file_surat_keluar)
                                        <button type="button" class="btn btn-info" onclick="showFile('{{ $item->file_surat_keluar }}')">
                                            <i class="fas fa-file-alt"></i>
                                        </button>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="action-btn btn-tampil" onclick="showDetail('{{ $item->id }}', 'keluar')" title="Tampil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('Laporan.modal_file')
</div>

<!-- Modal Detail -->
@include('Arsip.modal_detail')

@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#suratKeluarTable').DataTable();

            $('#suratMasukTable').DataTable();
        });

        function showDetail(id, type) {
            $.ajax({
                url: `/arsip/${type}/${id}`,
                type: 'GET',
                success: function(data) {
                    // Isi data detail surat ke dalam modal
                    $('#detailNoSurat').text(data.no_surat);
                    $('#detailIsiSingkat').text(data.isi_singkat);
                    $('#detailJenisSurat').text(data.jenis_surat);
                    $('#detailTanggalSurat').text(data.tgl_surat);

                    // Tampilkan berkas berdasarkan tipe file
                    const fileUrl = `/storage/${data.file_surat_masuk || data.file_surat_keluar}`;
                    const fileExtension = fileUrl.split('.').pop().toLowerCase();

                    const pdfViewer = $('#pdfViewer');
                    const imageViewer = $('#imageViewer');

                    // Reset tampilan viewer
                    pdfViewer.hide();
                    imageViewer.hide();

                    if (fileExtension === 'pdf') {
                        // Tampilkan PDF dalam iframe
                        pdfViewer.attr('src', fileUrl).show();
                    } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                        // Tampilkan gambar
                        imageViewer.attr('src', fileUrl).show();
                    }

                    // Show the download button for the user to download the file
                    $('#downloadBtn').attr('data-file-url', fileUrl).show();

                    // Tampilkan modal
                    $('#detailModal').modal('show');
                },
                error: function() {
                    alert('Gagal memuat data arsip.');
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
