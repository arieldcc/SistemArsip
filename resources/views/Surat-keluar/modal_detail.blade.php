<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Surat Keluar</h5>
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
                        <strong>Bagian:</strong>
                        <p id="detailBagian"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Tujuan Surat:</strong>
                        <p id="detailTujuanSurat"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Jenis Surat:</strong>
                        <p id="detailJenisSurat"></p>
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
                        <strong>Perihal Surat:</strong>
                        <p id="detailPerihalSurat"></p>
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
                            <a id="fileDownloadLink" href="#" target="_blank">Unduh Berkas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
