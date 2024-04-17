<html>
    <h1>Laporan Disposisi Surat Masuk</h1>
<table>
    <thead>
        <tr>
            <th><b>No</b></th>
            <th><b>No Surat</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Perihal</b></th>
            <th><b>Ditujukan</b></th>
            <th><b>Instruksi/Informasi</b></th>
            <th><b>Diteruskan Kepada</b></th>
        </tr>
    </thead>
    <tbody>
        @php
            $i=1;
        @endphp
          @foreach ($disposisi as $d)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $d->no_surat }}</td>
            <td>{{ $d->tanggal_surat }}</td>
            <td>{{ $d->perihal }}</td>
            <td>{{ $d->ditujukan }}</td>
            <td>{{ $d->isi_disposisi }}</td>
            <td>{{ $d->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>