<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            text-align: center;
        }
        .container {
            position: relative;
        }
        .logo2 {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ public_path("/img/logo.png") }}" alt="" style="width: 250px; height: 125px;">
        <center>
            <h1>Laporan Pengembalian Aset Alat Kantor</h1>
        </center>
        <table>
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Nama Barang</th>
                    <th>Serial Number</th>
                    <th>Status Pengembalian</th>
                    <th>Tgl Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengembalian as $pmj)
                @if($pmj->status_pengembalian === 'Dikembalikan')
                    <tr>
                        <td>{{ $pmj->name }}</td>
                        <td>{{ $pmj->nama_barang }} {{ $pmj->nomor_model }} - {{ strip_tags(htmlspecialchars_decode($pmj->detail)) }}</td>
                        <td>{{ $pmj->serial_number }}</td>
                        <td>{{ $pmj->status_pengembalian }}</td>
                        <td>{{ \Carbon\Carbon::parse($pmj->created_at)->format('d F Y') }}</td>
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <img src="{{ public_path("img/logo2.png") }}" alt="" class="logo2">
    </div>
</body>
</html>
