@extends('layouts.default')

@section('title','Tambah Data')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow p-2">
                <div class="card-body">
                    <form action="/admin/{{ $jenis_bg }}/tambah-data" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nm_barang">Nama Aset</label> <br>
                            <input id="nm_barang" type="text" name="nama_barang" class="form-control">
                            @error('nama_barang')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_model">Model</label> <br>
                            <input id="no_model" type="text" name="nomor_model" class="form-control">
                            @error('nomor_model')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>        
                        
                        <div class="form-group">
                            <label for="serial_number">Serial Number</label> <br>
                            <input id="serial_number" type="text" name="serial_number" class="form-control">
                            @error('serial_number')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        
                        <div class="form-group">
                            <label for="jn_barang">Jenis Aset</label> <br>
                            <select name="id_jenis_barang" id="jn_barang" class="form-control">
                                <option value="">Pilih</option>
                                @foreach($jenis_brg as $jbg)
                                    <option value="{{ $jbg->id_jenis_barang }}">{{ $jbg->jenis_barang }}</option>
                                @endforeach
                            </select>
                            @error('id_jenis_barang')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="profil">Input Gambar Asset</label>
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
                            <label for="">Detail Aset</label>
                            <textarea id="editor1" name="detail">
                                {{ old('detail') }}
                            </textarea>
                            @error('detail')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <a href="{{ url()->previous() }}" class="btn btn-md btn-info ml-2 mb-3 float-left">Kembali</a>&nbsp;
                                <button type="submit" class="btn btn-success">
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