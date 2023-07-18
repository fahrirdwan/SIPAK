@extends('layouts.default')

@section('title','Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">History Aset</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
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
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection