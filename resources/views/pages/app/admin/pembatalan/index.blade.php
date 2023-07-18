@extends('layouts.default')

@section('title','Pembatalan')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Peminjaman</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Peminjaman</th>
                                <th colspan="3">action</th>
                                <th style="display: none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $pmj)
                            @if($pmj->status_pengembalian === 'Proses Pengembalian')
                            <tr class="text-center">
                                <td>{{ $pmj->name }}</td>
                                <td>{{ $pmj->nama_barang.' '.$pmj->nomor_model }} ({{ $pmj->serial_number }})</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($pmj->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </td>
                                <td class="text-center">
                                    <a href="/admin/pembatalan-peminjaman/un-approval/{{ $pmj->id_peminjaman }}"
                                        class="btn btn-sm btn-warning"> <i class="fas fa-check"></i></a>
                                </td>
                                
                                
                                <th style="display: none"></th>
                            </tr>
                            @endif
                            @endforeach
                            </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pengembalian</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Pengembalian</th>
                                <th colspan="3">action</th>
                                <th style="display: none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengembalian as $pmj)
                            @if($pmj->kondisi_barang === '-')
                            <tr class="text-center">
                                <td>{{ $pmj->name }}</td>
                                <td>{{ $pmj->nama_barang.' '.$pmj->nomor_model }} ({{ $pmj->serial_number }})</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($pmj->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </td>
                                <td class="text-center">
                                    <a href="/admin/pembatalan-pengembalian/un-approval/{{ $pmj->id_pengembalian }}"
                                        class="btn btn-sm btn-warning"> <i class="fas fa-check"></i></a>
                                </td>
                                
                                
                                <th style="display: none"></th>
                            </tr>
                            @endif
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