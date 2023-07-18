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
        <th>Kondisi Barang</th>
        <th>Dibuat</th>
        <th>Diperbarui</th>
    </tr>
    </thead>
    <tbody>
    @foreach($check_kondisi as $chk)
        <tr>
            <td>{{ $chk->name }}</td>
            <td>{{ $chk->nama_barang }} {{ $chk->nomor_model }} - {{ strip_tags(htmlspecialchars_decode($chk->detail)) }}</td>
            <td>{{ $chk->serial_number }}</td>
            <td>{{ $chk->kondisi_barang }}</td>
            <td>{{ \Carbon\Carbon::parse($chk->created_at)->format('d F Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($chk->updated_at)->format('d F Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>