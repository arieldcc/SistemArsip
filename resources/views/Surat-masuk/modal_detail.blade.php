<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi Detail Surat -->
                <div class="row">
                    <div class="col-md-6">
                        <strong>No. Surat:</strong>
                        <p id="detailNoSurat"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Asal Surat:</strong>
                        <p id="detailAsalSurat"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Jenis Surat:</strong>
                        <p id="detailJenisSurat"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Perihal Surat:</strong>
                        <p id="detailPerihalSurat"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Tanggal Surat:</strong>
                        <p id="detailTglSurat"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Tanggal Terima:</strong>
                        <p id="detailTglTerima"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Tanggal Arsip:</strong>
                        <p id="detailTglArsip"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Status Disposisi:</strong>
                        <p id="detailStatusDisposisi"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Isi Singkat:</strong>
                        <p id="detailIsiSingkat"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Keterangan:</strong>
                        <p id="detailKeterangan"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Berkas Surat:</strong>
                        <div id="fileContainer">
                            <iframe id="pdfViewer" style="display: none;" width="100%" height="400px"></iframe>
                            <img id="imageViewer" style="display: none; width: 100%; max-height: 500px; object-fit: contain;" />
                        </div>
                    </div>
                </div>

                <!-- Detail Disposisi -->
                <div class="row mt-4" id="detailDisposisi" style="display: none;">
                    <div class="col-md-12">
                        <h5 class="text-primary">Detail Disposisi</h5>
                    </div>
                    <div class="col-md-6">
                        <strong>Bagian Disposisi:</strong>
                        <p id="disposisiBagian"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Sifat Disposisi:</strong>
                        <p id="disposisiSifat"></p>
                    </div>
                    <div class="col-md-12">
                        <strong>Isi Disposisi:</strong>
                        <p id="disposisiIsi"></p>
                    </div>
                    <div class="col-md-12">
                        <strong>Catatan:</strong>
                        <p id="disposisiCatatan"></p>
                    </div>
                </div>
                <!-- Akhir Detail Disposisi -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
