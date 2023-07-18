@extends('layouts.default')

@section('title','Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $hitung_peminjaman }}</h3>
                    <p>Peminjaman</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $hitung_pengembalian }}</h3>
                    <p>Pengembalian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $hitung_barang }}</h3>
                    <p>Barang Tersedia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $hitung_history }}</h3>
                    <p>History</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Tata Cara Peminjaman Aset Alat Kantor</h2><br>
                    <ol>
                        <li>Klik menu Kategori aset dan pilih aset yang ingin digunakan atau juga bisa klik menu Peminjaman pada menu di samping kiri</li>
                        <li>Bila memesan aset melalui kategori aset, dapat langsung mengisi form peminjaman sesuai dengan kebutuhan dan lengkapi semua form yang belum terisi</li>
                        <li>Apabila meminjam melalui menu peminjaman, klik tambah data kemudian pilih aset yang ingin digunakan dan isi form peminjaman sesuai dengan kebutuhan, lengkapi semua form yang belum terisi</li>
                        <li>Cek kembali data yang Anda input sudah benar dan sesuai</li>
                        <li>Klik Submit jika data yang Anda input sudah benar dan sesuai</li>
                        <li>Permohonan Peminjaman aset akan sampai ke notifikasi admin</li>
                        <li>Cek status peminjaman, apabila data peminjaman terhapus Anda dapat melakukan penginputan kembali data peminjaman</li>
                        <li>Perhatikan baik-baik lamanya peminjaman aset dengan melihat lonceng notifikasi di bagian atas kanan</li>
                        <li>Jika Anda telah selesai melakukan peminjaman aset, Anda dapat langsung mengembalikan aset kepada admin</li>
                        <li>Admin akan mengubah status pengembalian aset Anda apabila aset yang Anda kembalikan sesuai dengan yang dipinjam</li>
                        <li>Anda dapat melihat history peminjaman aset Anda pada menu history</li>
                        <li>Pada website ini, Anda juga dapat mengubah password default dengan password versi Anda, serta melengkapi profil Anda apabila profil Anda belum lengkap</li>
                        <li>Setelah selesai, Anda dapat logout pada fitur pojok kanan atas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
