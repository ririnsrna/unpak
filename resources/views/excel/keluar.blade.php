<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF Surat Keluar</title>
</head>
<body>
    <h1>Laporan Surat Keluar</h1>
    <table style="border:1px solid black">
        <thead style="background-color: green;border:1px solid black">
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Jenis Surat</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Ditujukkan</th>
                <th>Perihal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody style="border:1px solid black">
            @php
                $i = 1;
            @endphp
            @foreach($suratkeluar as $sk)
            <tr style="border:1px solid black">
                <td>{{ $i++ }}</td>
                <td>{{ $sk->no_surat }}</td>
                <td>{{ $sk->jenis_surat }}</td>
                <td>{{ $sk->tanggal_surat }}</td>
                <td>{{ $sk->pengirim }}</td>
                <td>{{ $sk->ditujukan }}</td>
                <td>{{ $sk->perihal }}</td>
                <td>{{ $sk->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>