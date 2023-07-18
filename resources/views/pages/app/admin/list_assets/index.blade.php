@extends('layouts.default')

@section('title','Kumpulan Asset')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <a href="/admin/list-asset/tambah-data" class="btn btn-primary mb-3">Tambah Data</a>
            <div class="card shadow p-2">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr class="text-center">
                            <th>Nama Barang</th>
                            <th>Model</th>
                            <th>Serial Number</th>
                            <th>Jenis Aset</th>
                            <th>Gambar</th>
                            <th colspan="3">action</th>
                            <th style="display: none"></th> 
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($barang as $brg)
                        <tr class="text-center">
                            <td>{{ $brg->nama_barang }}</td>
                            <td>{{ $brg->nomor_model }}</td>
                            <td>{{ $brg->serial_number }}</td>
                            <td>{{ $brg->jenis_barang }}</td>
                            <td> 
                                <a href="/img/aset/{{ $brg->gambar }}" data-fancybox>
                                    <img src="/img/aset/{{ $brg->gambar }}" width="100" height="80">
                                </a>
                            </td>
                            <td>
                                <a href="/admin/list-asset/edit/{{ $brg->id_barang }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="/admin/list-asset/detail/{{ $brg->id_barang }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                            </td>
                            <td>
                                <a onclick="return confirm('Apakah anda yakin ingin menghapus daya ini?')" href="/admin/list-asset/hapus/{{ $brg->id_barang }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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