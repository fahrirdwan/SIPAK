@extends('layouts.default')

@section('title','Kategori '.$jenis_brg->jenis_barang)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow p-2">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr class="text-center">
                            <th>Serial Number</th>
                            <th>Model</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Gambar</th>
                            <th>action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($barang as $brg)
                        <tr class="text-center">
                            <td>{{ $brg->serial_number }}</td>
                            <td>{{ $brg->nomor_model }}</td>
                            <td>{{ $brg->nama_barang }}</td>
                            <td>{{ $brg->jenis_barang }}</td>
                            <td> 
                                <a href="/img/aset/{{ $brg->gambar }}" data-fancybox>
                                    <img src="/img/aset/{{ $brg->gambar }}" width="100" height="80">
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="/user/list-asset/detail/{{ $brg->serial_number}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                            </td>
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