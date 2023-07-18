@extends('layouts.default')

@section('title','Tambah Data Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/user/pengembalian/tambah-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pengembali</label> <br>
                            <input type="text" value="{{ Auth::user()->name }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Barang</label> <br>
                            <select class="form-control" name="id_barang">
                                <option value="">Pilih</option>
                                @foreach($barang as $brg)
                                <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }} ({{ $brg->serial_number }})</option>
                                @endforeach
                            </select>
                            @error('id_barang')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pengembalian</label> <br>
                              <input type="date" class="form-control" name="created_at">
                              @error('created_at')<p class="text-danger">{{ $message }}</p>@enderror
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