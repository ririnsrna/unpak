<html>
    <h1>Laporan Surat Keluar</h1>
<table>
    <thead>
        <tr>
            <th><b>No</b></th>
            <th><b>No Surat</b></th>
            <th><b>Tanggal</b></th>
            <th><b>Pengirim</b></th>
            <th><b>Ditujukan</b></th>
            <th><b>Perihal</b></th>
            
        </tr>
    </thead>
    <tbody>
        @php
            $i=1;
        @endphp
          @foreach ($suratkeluar as $sk)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $sk->no_surat }}</td>
            <td>{{ $sk->tanggal_surat }}</td>
            <td>{{ $sk->pengirim }}</td>
            <td>{{ $sk->ditujukan }}</td>
            <td>{{ $sk->perihal }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>