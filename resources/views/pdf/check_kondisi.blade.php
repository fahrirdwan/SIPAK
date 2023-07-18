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
            text-align: left;
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
            <h1>Laporan Check Kondisi Aset Alat Kantor</h1>
        </center>
        <table>
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Nama Barang</th>
                    <th>Serial Number</th>
                    <th>Dibuat</th>
                    <th>Diperbarui</th>
                    <th>Kondisi Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($check_kondisi as $chk)
                <tr>
                    <td>{{ $chk->name }}</td>
                    <td>{{ $chk->nama_barang }} {{ $chk->nomor_model }} - {{ strip_tags(htmlspecialchars_decode($chk->detail)) }}</td>
                    <td>{{ $chk->serial_number }}</td>
                    <td>{{ \Carbon\Carbon::parse($chk->created_at)->format('d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($chk->updated_at)->format('d F Y') }}</td>
                    <td>{{ $chk->kondisi_barang }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <img src="{{ public_path("img/logo2.png") }}" alt="" class="logo2">
    </div>
</body>
</html>
