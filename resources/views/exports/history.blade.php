<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
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
                <td>{{ $history->nama_barang}}</td>
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