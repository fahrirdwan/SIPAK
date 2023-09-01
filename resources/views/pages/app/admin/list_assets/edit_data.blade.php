@extends('layouts.default')

@section('title','Edit Data Asset')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow p-2">
                <div class="card-body">
                    <form action="/admin/list-asset/edit-data/{{ $barang->serial_number }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="no_model">Model</label> <br>
                            <input id="no_model" type="text" name="nomor_model" class="form-control" value="{{ $barang->nomor_model }}">
                            @error('nomor_model')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="nm_barang">Nama Barang</label> <br>
                            <input id="nm_barang" type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}">
                            @error('nama_barang')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="jn_barang">Jenis Barang</label> <br>
                            <select name="id_jenis_barang" class="form-control">
                                <option value="{{ $barang->id_jenis_barang }}"> {{ $barang->jenis_barang }}</option>
                                @foreach($jenis_barang as $jgp)
                                <option value="{{ $jgp->id_jenis_barang }}"> {{ $jgp->jenis_barang }}</option>
                                @endforeach
                            </select>
                            @error('id_jenis_barang')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="profil">Edit Gambar Asset</label>
                            <img class="img-fluid rounded mb-3" id="output" width="150" style="display: block" />
                            <input type="file" name="gambar" class="form-control" accept="image/*" id="file" onchange="loadFile(event)">
                            @error('gambar')<p class="text-danger">{{ $message }}</p> @enderror
                            <script type="text/javascript">
                            let loadFile = function(event) {
                                let image = document.getElementById('output');
                                image.src = URL.createObjectURL(event.target.files[0]);
                            };
                            </script>
                        </div>
                        <div class="mb-3">
                            <label for="">Detail Barang</label>
                            <textarea id="editor1" name="detail">
                                {{ $barang->detail }}
                            </textarea>
                            @error('detail')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a href="{{ url()->previous() }}" class="btn btn-md btn-info ml-2 mb-3 float-left">Kembali</a>&nbsp;
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