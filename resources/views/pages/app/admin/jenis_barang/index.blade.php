@extends('layouts.default')

@section('title','Jenis Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <a href="/admin/jenis-barang/tambah-data" class="btn btn-primary mb-3">Tambah Data</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Jenis Aset</th>
                                    <th colspan="2" width="20%">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barang as $brg)
                                <tr class="text-center">
                                    <td>{{ $brg->jenis_barang }}</td>
                                    <td>
                                        <a href="/admin/jenis-barang/edit/{{ $brg->id_jenis_barang }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Apakah anda yakin ingin menghapus daya ini?')" href="/admin/jenis-barang/hapus/{{ $brg->id_jenis_barang }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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