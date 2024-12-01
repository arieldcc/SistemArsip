@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan</h1>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="laporanTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="bagian-tab" data-toggle="tab" href="#bagian" role="tab" aria-controls="bagian" aria-selected="true">Bagian</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="suratMasuk-tab" data-toggle="tab" href="#suratMasuk" role="tab" aria-controls="suratMasuk" aria-selected="false">Surat Masuk</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="disposisi-tab" data-toggle="tab" href="#disposisi" role="tab" aria-controls="disposisi" aria-selected="false">Disposisi</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="suratKeluar-tab" data-toggle="tab" href="#suratKeluar" role="tab" aria-controls="suratKeluar" aria-selected="false">Surat Keluar</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="laporanTabContent">
        <!-- Bagian Tab -->
        <div class="tab-pane fade show active" id="bagian" role="tabpanel" aria-labelledby="bagian-tab">
            @include('Laporan.bagian')
        </div>

        <!-- Surat Masuk Tab -->
        <div class="tab-pane fade" id="suratMasuk" role="tabpanel" aria-labelledby="suratMasuk-tab">
            @include('Laporan.surat_masuk')
        </div>

        <!-- Disposisi Tab -->
        <div class="tab-pane fade" id="disposisi" role="tabpanel" aria-labelledby="disposisi-tab">
            @include('Laporan.disposisi')
        </div>

        <!-- Surat Keluar Tab -->
        <div class="tab-pane fade" id="suratKeluar" role="tabpanel" aria-labelledby="suratKeluar-tab">
            @include('Laporan.surat_keluar')
        </div>
    </div>

    @include('Laporan.modal_file')
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bagianTable').DataTable();
        $('#suratMasukTable').DataTable();
        $('#disposisiTable').DataTable();
        $('#suratKeluarTable').DataTable();
    });

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

