@extends('layouts.default')

@section('title','Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <center>
                        <img src="/img/profil/{{ $user->picture }}" alt="" width="175px" class=" img-fluid rounded-circle mt-3">
                    </center>
                    <table class="table mt-3">
                        <tr>
                            <td>Nama </td>
                            <td>{{ $user->name }} </td>
                        </tr>
                        <tr>
                            <td>NIP </td>
                            <td>{{ $user->nip }} </td>
                        </tr>
                        <tr>
                        <tr>
                            <td>Tanggal Lahir </td>
                            <td>{{ $user->tgl_lahir }} </td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td>{{ $user->email }} </td>
                        </tr>
                        <tr>
                            <td>Jabatan </td>
                            <td>{{ $user->jabatan }} </td>
                        </tr>
                        <tr>
                            <td>No.hp </td>
                            <td>{{ $user->phone_number }} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow p-2">
                <div class="card-body">
                    <form action="/user/update-profil" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="profil">Ubah Profil</label>
                            <input type="file" name="picture" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Masukan Nama Lengkap</label> <br>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="text">NIP</label>
                            <input type="text" class="form-control" value="{{ $user->nip }}" name="nip">
                        </div>
                        <div class="form-group">
                            <label for="text">Tanggal Lahir</label>
                            <input type="date" class="form-control" value="{{ $user->tgl_lahir }}" name="tgl_lahir">
                        </div>
                        <div class="form-group">
                            <label for="text">No.Hp</label>
                            <input type="text" class="form-control" value="{{ $user->phone_number }}" name="phone_number">
                        </div>
                        <div class="form-group">
                            <label for="text">Jabatan</label>
                            <input type="text" class="form-control" value="{{ $user->jabatan }}" name="jabatan">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-send"></i>
                                    Edit Profil
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