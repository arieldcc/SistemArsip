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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
