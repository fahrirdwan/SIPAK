@extends('layouts.default')

@section('title','Detail Check Kondisi')

{{-- @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <center>
                        <img src="/img/profil/{{ $pengembalian->picture }}" alt="" width="175" class="img-fluid mt-3 rounded-circle">
                    </center>
                    <table class="table mt-3">
                        <tr>
                            <td>Nama </td>
                            <td>{{ $pengembalian->name }} </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>{{ $pengembalian->email }}  </td>
                        </tr>
                        <tr>
                            <td>NIP </td>
                            <td>{{ $pengembalian->nip }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan </td>
                            <td>{{ $pengembalian->jabatan }}  </td>
                        </tr>
                        <tr>
                            <td>No.hp </td>
                            <td>{{ $pengembalian->phone_number }}  </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <center>
                        <a href="/img/aset/{{ $pengembalian->gambar }}" data-fancybox>
                            <img src="/img/aset/{{ $pengembalian->gambar }}" class="img-fluid" width="250">
                        </a>
                   </center>
                   <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <td>{{ $pengembalian->serial_number }}</td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>{{ $pengembalian->nama_barang }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Barang</th>
                                <td>{{ $pengembalian->jenis_barang }}</td>
                            </tr>
                            <tr>
                                <th width="28%">Tanggal Pengembalian</th>
                                <td>{{ \Carbon\Carbon::parse($pengembalian->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td valign="top"><b>Detail</b></td>
                                <td><?= $pengembalian->detail ?></td>
                            </tr>
                        </thead>
                   </table>
                   <td class="text-center" >
                    <a href="/admin/pengembalian/surat/{{ $pengembalian->id_pengembalian }}" class="btn btn-sm btn-success mt-3 float-right">Print berita acara</a>
                </td>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}