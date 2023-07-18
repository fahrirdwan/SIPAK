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
        <th>Status Pengembalian</th>
        <th>Tanggal Pengembalian</th>
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