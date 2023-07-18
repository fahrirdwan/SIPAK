@extends('lAyouts.default')

@section('title','Detail Peminjam')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/user/peminjaman" class="btn btn-md btn-info ml-2 mb-3 float-left">Kembali</a>
        <div class="col-lg-12">
            <div class="card shadow p-5">
                <div class="card-body">
                    <center>
                        <img src="/img/aset/{{ $barang->gambar }}" class="img-fluid rounded" width="550">
                   </center>
                   <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>Model</th>
                                <td>{{ $barang->nomor_model }}</td>
                            </tr>
                            <tr>
                                <th>Serial Number</th>
                                <td>{{ $barang->serial_number }}</td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>{{ $barang->nama_barang }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Barang</th>
                                <td>{{ $barang->jenis_barang }}</td>
                            </tr>
                            <tr>
                                <td valign="top"><b>Detail</b></td>
                                <td><?= $barang->detail ?></td>
                            </tr>
                            <tr>
                                <th>Diperbarui</th>
                                <td>{{ \Carbon\Carbon::parse($barang->updated_at)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ \Carbon\Carbon::parse($barang->created_at)->format('d F Y') }}</td>
                            </tr>
                        </thead>
                        
                   </table>
                   {{-- @if($barang->status_barang === 1) 
                   <a href="/user/peminjaman/tambah-data" class="btn btn-md btn-success mt-3 float-right">Pinjam Aset</a>
                   @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection