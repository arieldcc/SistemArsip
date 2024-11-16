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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
