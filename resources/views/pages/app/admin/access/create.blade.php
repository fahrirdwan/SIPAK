@extends('layouts.default')

@section('title','Tambah Akun')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/admin/user-access/store" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama *</label> <br>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email *</label> <br>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>NIP *</label> <br>
                            <input type="text" name="nip" class="form-control" value="{{ old('nip') }}">
                            @error('nip')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Akses Sebagai *</label> <br>
                            <select name="id_role" class="form-control">
                                <option value="">Pilih</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id_role }}">{{ $role->name_role }}</option>
                                @endforeach
                            </select>
                            @error('id_role')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label> <br>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}">
                        </div>
                        <div class="form-group">
                            <label>Divisi</label> <br>
                            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label> <br>
                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
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