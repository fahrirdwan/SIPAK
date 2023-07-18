<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<table>
    <thead>
    <tr>
        <th>Nama Karyawan</th>
        <th>Nama Barang</th>
        <th>Serial Number</th>
        <th>Durasi Peminjaman</th>
        <th>Status Peminjaman</th>
        <th>Tanggal Peminjaman</th>
    </tr>
    </thead>
    <tbody>
    @foreach($peminjaman as $pmj)
    @if($pmj->status_peminjaman === 'Dipinjam' AND $pmj->status_pengembalian === 'Proses Pengembalian')
        <tr>
            <td>{{ $pmj->name }}</td>
            <td>{{ $pmj->nama_barang }} {{ $pmj->nomor_model }} - {{ strip_tags(htmlspecialchars_decode($pmj->detail)) }}</td>
            <td>{{ $pmj->serial_number }}</td>
            <td>
                @if($pmj->durasi_peminjaman >= 30)
                {{ $pmj->durasi_peminjaman/30 }} Bulan
                @elseif($pmj->durasi_peminjaman >= 7)
                {{ $pmj->durasi_peminjaman/7 }} Minggu
                @elseif($pmj->durasi_peminjaman >= 360)
                {{ $pmj->durasi_peminjaman/7 }} Tahun
                @else
                {{ $pmj->durasi_peminjaman }} hari
                @endif
            </td>
            <td>{{ $pmj->status_peminjaman }}</td>
            <td>{{ \Carbon\Carbon::parse($pmj->created_at)->format('d F Y') }}</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>