@extends('layouts.default')

@section('title','Kategori '.$jenis_brg->jenis_barang)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <a href="/admin/{{ $jenis_brg->jenis_barang }}/tambah-data" class="btn btn-primary mb-3">Tambah Data</a>
            <div class="card shadow p-2">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr class="text-center">
                            <th>Nama Aset</th>
                            <th>Model</th>
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
                            <td>{{ $brg->jenis_barang }}</td>
                            <td> 
                                <a href="/img/aset/{{ $brg->gambar }}" data-fancybox>
                                    <img src="/img/aset/{{ $brg->gambar }}" width="100">
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="/admin/{{ $brg->jenis_barang }}/edit/{{ $brg->serial_number }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="/admin/list-asset/detail/{{ $brg->serial_number}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                            </td>
                            <td class="text-center">
                                <a onclick="return confirm('Apakah anda yakin ingin menghapus aset ini?')" href="/admin/{{ $brg->jenis_barang }}/hapus/{{  $brg->serial_number }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                            <th style="display: none"></th> 
                        </tr>
                        @endforeach
                      </tfoot>
                    </table>
                  </div>
               
                <div class="card-body">
                   
                    <table class="table table-bordered">
                        <thead class="bg-danger">
                            
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection