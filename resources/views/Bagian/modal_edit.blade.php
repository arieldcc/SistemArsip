<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Bagian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="bagianId" name="id">
                    <div class="form-group">
                        <label for="editNamaBagian">Nama Bagian</label>
                        <input type="text" class="form-control" id="editNamaBagian" name="nama_bagian" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Tombol Tutup dengan ikon "Times" -->
                <button type="button" class="btn btn-tutup" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
                <!-- Tombol Simpan Perubahan dengan ikon "Save" -->
                <button type="button" class="btn btn-simpan" id="saveChangesBtn">
                    <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
    </div>
</div>
