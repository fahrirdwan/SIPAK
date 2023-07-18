@extends('layouts.default')

@section('title','Detail Peminjam')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <center>
                        <img src="/img/profil/{{ $peminjaman->picture }}" alt="" width="175px" class="mt-3 rounded-circle">
                    </center>
                    <table class="table mt-3">
                        <tr>
                            <td>Nama </td>
                            <td>{{ $peminjaman->name }} </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>{{ $peminjaman->email }}  </td>
                        </tr>
                        <tr>
                            <td>NIP </td>
                            <td>{{ $peminjaman->nip }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan </td>
                            <td>{{ $peminjaman->jabatan }}  </td>
                        </tr>
                        <tr>
                            <td>No.hp </td>
                            <td>{{ $peminjaman->phone_number }}  </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <center>
                        <img src="/img/aset/{{ $peminjaman->gambar }}" alt="">
                   </center>
                   <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <td>{{ $peminjaman->nama_barang }}</td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td>{{ $peminjaman->nomor_model }}</td>
                            </tr>
                            <tr>
                                <th>Serial Number</th>
                                <td>{{ $peminjaman->serial_number }}</td>
                            </tr>
                            <tr>
                                <th width="26%">Tanggal Peminjaman</th>
                                <td>{{ \Carbon\Carbon::parse($peminjaman->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Durasi Peminjaman</th>
                                <td>
                                    @if($peminjaman->durasi_peminjaman >= 30)
                                    {{ $peminjaman->durasi_peminjaman/30 }} Bulan
                                    @elseif($peminjaman->durasi_peminjaman >= 7)
                                    {{ $peminjaman->durasi_peminjaman/7 }} Minggu
                                    @elseif($peminjaman->durasi_peminjaman >= 360)
                                    {{ $peminjaman->durasi_peminjaman/7 }} Tahun
                                    @else
                                    {{ $peminjaman->durasi_peminjaman }} hari
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Barang</th>
                                <td>{{ $peminjaman->jenis_barang }}</td>
                            </tr>
                            
                            <tr>
                                <td valign="top"><b>Detail</b></td>
                                <td><?= $peminjaman->detail ?></td>
                            </tr>
                            </thead>
                   </table>
                   <td class="text-center" >
                    <a href="/admin/peminjaman/surat/{{ $peminjaman->id_peminjaman }}" class="btn btn-sm btn-success mt-3 float-right">Print berita acara</a>
                    </td>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection