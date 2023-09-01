@extends('layouts.default')

@section('title','Tambah Jenis Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/admin/peminjaman/tambah" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Karyawan</label> <br>
                            <select class="form-control js-example-basic-multiple" name="nip" multiple="multiple">
                                <option value="">Pilih</option>
                                @foreach($users as $user)
                                <option value="{{ $user->nip }}">{{ $user->name }}</option>
                                @endforeach
                              </select>
                            @error('nip')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label>Barang</label> <br>
                            <select class="form-control js-example-basic-multiple" name="serial_number" multiple="multiple">
                                <option></option>
                                @foreach($barang as $brg)
                                <option value="{{ $brg->serial_number }}">{{ $brg->nama_barang }} {{ $brg->nomor_model }} ({{ $brg->serial_number}}) - {!! $brg->detail !!}</option>
                                @endforeach
                              </select>
                            @error('serial_number')<p class="text-danger">{{ $message }}</p>@enderror
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