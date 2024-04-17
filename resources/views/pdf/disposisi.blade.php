<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF Disposisi</title>
</head>
<body>
    <h1>Laporan Disposisi Surat Masuk</h1>
    <table style="border:1px solid black">
        <thead style="background-color: green;border:1px solid black">
            <tr>
                <th style="border:1px solid black">No</th>
                <th style="border:1px solid black">Nomor Surat</th>
                <th style="border:1px solid black">Tanggal</th>
                <th style="border:1px solid black">Perihal</th>
                <th style="border:1px solid black">Ditujukkan</th>
                <th style="border:1px solid black">Instruksi/Informasi</th>
                <th style="border:1px solid black">Diteruskan Kepada</th>
            </tr>
        </thead>
        <tbody style="border:1px solid black">
            @php
                $i = 1;
            @endphp
            @foreach($disposisi as $d)
            <tr style="border:1px solid black">
                <td style="border:1px solid black">{{ $i++ }}</td>
                <td style="border:1px solid black">{{ $d->no_surat }}</td>
                <td style="border:1px solid black">{{ $d->tanggal_surat }}</td>
                <td style="border:1px solid black">{{ $d->perihal }}</td>
                <td style="border:1px solid black">{{ $d->ditujukan }}</td>
                <td style="border:1px solid black">{{ $d->isi_disposisi }}</td>
                <td style="border:1px solid black">{{ $d->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>