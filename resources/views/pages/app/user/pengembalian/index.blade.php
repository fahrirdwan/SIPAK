@extends('layouts.default')

@section('title','Pengembalian')

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
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Status pengembalian</th>
                            <th>Approval</th>
                            <th>Tanggal Pengembalian</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($pengembalian as $pmj)
                            @if($pmj->status_pengembalian === 'Proses Pengembalian')
                            <tr>
                                <td>{{ $pmj->serial_number }}</td>
                                <td>{{ $pmj->nama_barang.' '.$pmj->nomor_model }} - {!! $pmj->detail !!}</td>
                                <td>{{ $pmj->jenis_barang }}</td>
                                <td class="text-center">
                                    @if($pmj->status_pengembalian === 'Proses Pengembalian')
                                    <span class="badge bg-primary text-white">Proses Pengembalian</span>
                                    @else
                                    <span class="badge bg-success text-white">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($pmj->confirmed === 1)
                                    <span class="badge bg-primary"><i class="fas fa-check"></i></span>
                                    @else
                                    <span class="badge bg-danger"><i class="fas fa-times"></i></span>
                                    @endif
                                </td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($pmj->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                            </tr>
                            @endif
                            @endforeach
                      </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection