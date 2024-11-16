<div class="table-responsive mt-4">
    <table id="bagianTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>NO.</th>
                <th>Nama Bagian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bagian as $index=>$item)
                <tr>
                    <td>{{ $index+=1 }}</td>
                    <td>{{ $item->nama_bagian }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
