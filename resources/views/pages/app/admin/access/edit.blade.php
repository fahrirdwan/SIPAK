@extends('layouts.default')

@section('title','Memperbarui Akun')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/admin/user-access/update/{{ $user->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama *</label> <br>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            @error('name')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>NIP</label> <br>
                            <input type="text" class="form-control" name="nip" value="{{ $user->nip }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Akses Sebagai</label> <br>
                            <select name="id_role" class="form-control">
                                <option value="{{ $user->id_role }}">{{ $user->name_role }}</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id_role }}">{{ $role->name_role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email *</label> <br>
                            <input type="text" class="form-control" value="{{ $user->email }}"readonly>
                        </div>
                        <div class="form-group">
                            <label>Tgl Lahir</label> <br>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ $user->tgl_lahir }}">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label> <br>
                            <input type="text" name="jabatan" class="form-control" value="{{ $user->jabatan }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label> <br>
                            <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}">
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