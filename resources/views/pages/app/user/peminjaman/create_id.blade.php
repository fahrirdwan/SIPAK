@extends('layouts.default')

@section('title','Tambah Data Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/user/peminjaman/tambah-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Peminjam</label> <br>
                            <input type="text" value="{{ Auth::user()->name }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Barang</label> <br>
                                <input type="text" value="{{ $barang->nama_barang }} ({{ $barang->serial_number}}) - {{ strip_tags(htmlspecialchars_decode($barang->detail)) }}" 
                                class="form-control" readonly>
                                <input type="hidden" value="{{ $barang->id_barang }}" name="id_barang">
                            @error('id_barang')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Durasi Peminjaman</label>
                                    <input type="number" name="angka" class="form-control">
                                    @error('angka')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jangka Waktu</label>
                                    <select name="jangka_pinjam" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="1">Hari</option>
                                        <option value="7">Minggu</option>
                                        <option value="30">Bulan</option>
                                        <option value="360">Tahun</option>
                                    </select>
                                    @error('jangka_pinjam')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Tanggal Peminjaman</label> <br>
                                      <input type="date" min="{{ date('Y-m-d') }}" class="form-control" name="created_at">
                                      @error('created_at')<p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-send"></i>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection