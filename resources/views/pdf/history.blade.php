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
            <h1>Laporan Gabungan Aset Alat Kantor</h1>
        </center>
        <table>
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Aset</th>
                    <th>Jenis Aset</th>
                    <th>Tanggal Peminajam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Keterangan Aset</th>
                    <th>Status</th>
                    <th style="display: none"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $history->name}}</td>
                    <td>{{ $history->nama_barang }} {{ $history->nomor_model }} - {{ strip_tags(htmlspecialchars_decode($history->detail)) }}</td>
                    <td>{{ $history->jenis_barang}}</td>
                    <td>{{ \Carbon\Carbon::parse($history->tgl_peminjaman)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($history->tgl_pengembalian)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                    <td>{{ $history->kondisi_barang}}</td>
                    <td>
                        <span class="badge ">{{ $history->status }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <img src="{{ public_path("img/logo2.png") }}" alt="" class="logo2">
    </div>
</body>
</html>