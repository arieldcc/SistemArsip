<div class="table-responsive mt-4">
    <table id="disposisiTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No Surat</th>
                <th>Bagian Disposisi</th>
                <th>Isi Disposisi</th>
                <th>Sifat</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disposisi as $item)
                <tr>
                    <td>{{ $item->suratMasuk->no_surat }}</td>
                    <td>{{ $item->bagian->nama_bagian ?? '-' }}</td>
                    <td>{{ $item->isi_disposisi }}</td>
                    <td>{{ ucfirst($item->sifat) }}</td>
                    <td>{{ $item->catatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
