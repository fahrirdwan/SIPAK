@extends('layouts.default')

@section('title','Edit Jenis Barang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/admin/jenis-barang/edit-data/{{ $barang->id_jenis_barang }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="jn_barang">Jenis Barang</label> <br>
                            <input id="jn_barang" type="text" name="jenis_barang" class="form-control" value="{{ $barang->jenis_barang }}">
                            @error('jenis_barang')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <a href="/admin/jenis_barang" class="btn btn-md btn-info ml-2 mb-3 float-left">Kembali</a>&nbsp;
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