@extends('layouts.default')

@section('title','Pengembalian')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="col-4">
                <a href="/admin/pengembalian/tambah" class="btn btn-primary mb-3">Tambah Data</a>
            </div> --}}
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Pengembalian</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr class="text-center">
                        <th>Nama Karyawan</th>
                        <th>Serial Number</th>
                        <th>Nama Barang</th>
                        <th>Status pengembalian</th>
                        <th>Tanggal Pengembalian</th>
                        <th colspan="3">action</th>
                        <th style="display: none"></th> 
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($pengembalian as $pmj)
                            <tr class="text-center">
                                <td>{{ $pmj->name }}</td>
                                <td>{{ $pmj->serial_number }}</td>
                                <td>{{ $pmj->nama_barang.' '.$pmj->nomor_model }}</td>
                                <td>
                                    @if($pmj->status_pengembalian == 'Proses Pengembalian')
                                        <span class="badge bg-primary text-white">Proses Pengembalian</span>
                                        @else
                                        <span class="badge bg-success text-white">Dikembalikan</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">{{ \Carbon\Carbon::parse($pmj->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                                <td>
                                    @if($pmj->status_peminjaman === 'Dipinjam')
                                        @if($pmj->confirmed == 0)
                                        <a href="/admin/pengembalian/approval/{{ $pmj->id_pengembalian }}" class="btn btn-sm btn-primary"><i class="fas fa-check"></i></a>
                                        @else
                                        
                                        @endif
                                    @else
                                        -
                                    @endif
                                <td>
                                    <a href="/admin/pengembalian/detail/{{ $pmj->id_pengembalian }}" class="btn btn-sm btn-success"> <i class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    @if($pmj->status_pengembalian === 'Dikembalikan')
                                    <a href="/admin/pengembalian/hapus/{{ $pmj->id_pengembalian }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"> <i class="fas fa-trash"></i></a>
                                    @endif
                                </td>
                                <th style="display: none"></th> 
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