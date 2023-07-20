@extends('layouts.default')

@section('title','Check Kondisi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr class="text-center">
                            <th>Nama Karyawan</th>
                            <th>Nama Aset</th>
                            <th>Serial Number</th>
                            <th>Kondisi Aset</th>
                            <th>Dipinjam</th>
                            <th>Dikembalikan</th>
                            <th colspan="3">Action</th>
                            <th style="display: none"></th> 
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($check_kondisi as $check)
                        <tr class="text-center">
                            <td>{{ $check->name }}</td>
                            <td>{{ $check->nama_barang.' '.$check->nomor_model }}</td>
                            <td>{{ $check->serial_number }}</td>
                            <td>{{ $check->kondisi_barang }}</td>
                            <td>{{ \Carbon\Carbon::parse($check->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($check->updated_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>
                                <a href="/admin/check-kondisi/edit/{{ $check->id_check_kondisi }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="/admin/check-kondisi/hapus/{{ $check->id_check_kondisi }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></a>
                            </td>
                            <td>
                                <a href="/admin/pengembalian/surat/{{ $check->id_check_kondisi }}" class="btn btn-primary"> <i class="fas fa-eye"></i></a>
                            </td>
                            <th style="display: none"></th> 
                        </tr>
                       @endforeach
                      </tfoot>
                    </table>
                  </div>
               
            </div>
        </div>
    </div>
</div>
@endsection