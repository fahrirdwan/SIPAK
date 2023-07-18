@extends('layouts.default')

@section('title','Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <a href="/user/peminjaman/tambah-data" class="btn btn-primary mb-3">Tambah Data</a>
            <div class="card shadow p-2">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr class="text-center">
                            <th>Serial Number</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Durasi Peminjaman</th>
                            <th>Status Peminjaman</th>
                            <th>Approval</th>
                            <th>Tgl Peminjaman</th>
                            <th colspan="2">Action</th>
                            <th style="display: none"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($peminjaman as $pmj)
                        @if($pmj->status_peminjaman === 'Diproses')
                        <tr>
                            <td>{{ $pmj->serial_number }}</td>
                            <td>{{ $pmj->nama_barang.' '.$pmj->nomor_model }}</td>
                            <td>{{ $pmj->jenis_barang }}</td>
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
                                @if($pmj->status_peminjaman === 'Diproses')
                                <span class="badge bg-primary text-white">{{ $pmj->status_peminjaman }}</span>
                                @else
                                <span class="badge bg-success text-white">{{ $pmj->status_peminjaman }}</span>
                                @endif
                            </td>
                            <td>
                                @if($pmj->confirmed === 1)
                                <span class="badge bg-primary"><i class="fas fa-check"></i></span>
                                @else
                                <span class="badge bg-danger"><i class="fas fa-times"></i></span>
                                @endif
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($pmj->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>
                                <a href="/user/peminjaman/detail-peminjaman/{{ $pmj->id_barang }}" class="btn btn-md btn-success"> <i class="fas fa-eye"></i></a> 
                            </td>
                            <td>
                                @if($pmj->confirmed === 0)
                                <form action="/user/peminjaman/{{ $pmj->id_peminjaman }}" method="POST">
                                    @csrf @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Ingin menghapus data?')"><i class="fas fa-window-close"></i></button>
                                </form>
                                @else
                                <button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i></button>
                                @endif
                            </td>
                            <th style="display: none"></th>
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