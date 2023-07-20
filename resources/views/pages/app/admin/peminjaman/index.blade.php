@extends('layouts.default')

@section('title','Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <a href="/admin/peminjaman/tambah" class="btn btn-primary mb-3">+ Tambah Data</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Peminjam Aset</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" data-order='[[0,"asc"]]' class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Serial Number</th>
                                <th>Nama Aset</th>
                                <th>Durasi Peminjaman</th>
                                <th>Status Peminjaman</th>
                                <th>Tanggal Peminjaman</th>
                                <th colspan="3">action</th>
                                <th style="display: none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $pmj)
                            @if($pmj->status_peminjaman === 'Diproses')
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pmj->name }}</td>
                                <td>{{ $pmj->serial_number }}</td>
                                <td>{{ $pmj->nama_barang.' '.$pmj->nomor_model }}</td>
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
                                <td>
                                    @if($pmj->status_pengembalian === 'Dikembalikan')
                                    <span class="badge bg-primary text-white">Sudah Dikembalikan</span>
                                    @else
                                        @if($pmj->status_peminjaman === 'Diproses')
                                        <span class="badge bg-warning text-white">{{ $pmj->status_peminjaman }}</span>
                                        @else
                                        <span class="badge bg-success text-white">{{ $pmj->status_peminjaman }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($pmj->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </td>
                                <td class="text-center">
                                    @if($pmj->confirmed === 0 && $pmj->status_barang === 1)
                                    <a href="/admin/peminjaman/approval/{{ $pmj->id_peminjaman }}"
                                        class="btn btn-sm btn-primary"> <i class="fas fa-check"></i></a>
                                    @elseif($pmj->confirmed === 0 && $pmj->status_barang === 0)
                                    -
                                    @else
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="/admin/peminjaman/detail/{{ $pmj->id_peminjaman }}"
                                        class="btn btn-sm btn-success"> <i class="fas fa-eye"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="/admin/peminjaman/hapus/{{ $pmj->id_peminjaman }}"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"> <i
                                            class="fas fa-trash"></i></a>
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