<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF Surat Masuk</title>
</head>

<body>
    <h1>Laporan Surat Masuk</h1>
    <table style="border:1px solid black">
        <thead style="background-color: green;border:1px solid black">
            <tr style="border:1px solid black">
                <th style="border:1px solid black">No</th>
                <th style="border:1px solid black">Nomor Surat</th>
                <th style="border:1px solid black">Tanggal</th>
                <th style="border:1px solid black">Pengirim</th>
                <th style="border:1px solid black">Ditujukkan</th>
                <th style="border:1px solid black">Perihal</th>
                <th style="border:1px solid black">Status</th>
            </tr>
        </thead>
        <tbody style="border:1px solid black">
            @php
                $i = 1;
            @endphp
            @foreach ($suratmasuk as $sm)
                <tr style="border:1px solid black">
                    <td style="border:1px solid black">{{ $i++ }}</td>
                    <td style="border:1px solid black">{{ $sm->no_surat }}</td>
                    <td style="border:1px solid black">{{ $sm->tanggal_surat }}</td>
                    <td style="border:1px solid black">{{ $sm->pengirim }}</td>
                    <td style="border:1px solid black">{{ $sm->ditujukan }}</td>
                    <td style="border:1px solid black">{{ $sm->perihal }}</td>
                    <td style="border:1px solid black">{{ $sm->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
