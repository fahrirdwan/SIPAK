@extends('layouts.default')

@section('title','Tambah Jenis Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/admin/peminjaman/edit/{{ $peminjaman->id_peminjaman }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Karyawan</label> <br>
                            <input type="text" value="{{ $peminjaman->name }}" class="form-control" readonly>
                            @error('id_user')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label>Barang</label> <br>
                            <select class="form-control" name="serial_number">
                                <option value="{{ $peminjaman->serial_number }}">{{ $peminjaman->nama_barang }}</option>
                                @foreach($barang as $brg)
                                <option value="{{ $brg->serial_number }}">{{ $brg->nama_barang }}</option>
                                @endforeach
                            </select>
                            @error('serial_number')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label>Durasi Peminjaman</label> <br>
                            <select class="form-control" name="durasi_peminjaman">
                            <option value="{{ $peminjaman->durasi_peminjaman }}"> {{ $peminjaman->durasi_peminjaman }} </option>
                                <option>1 Minggu</option>
                                <option>1 Bulan</option>
                                <option>1 Tahun</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label> <br>
                            <select class="form-control" name="status_peminjaman">
                                <option value="{{ $peminjaman->status_peminjaman }}">{{ $peminjaman->status_peminjaman }}</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Dipinjam">Dipinjam</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            </select>
                            @error('status_peminjaman')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label>Penanggung Jawab</label> <br>
                              <input type="text" class="form-control" name="" value="">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Peminjaman</label> <br>
                            <input type="date" class="form-control" name="created_at" value="{{ date('Y-m-d', strtotime($peminjaman->created_at)) }}">
                            @error('created_at')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pengembalian</label> <br>
                              <input type="date" class="form-control" name="updated_at" value="{{ date('Y-m-d', strtotime($peminjaman->updated_at)) }}">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-send"></i>
                                    Update
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