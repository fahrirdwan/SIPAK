@extends('layouts.default')

@section('title','Ganti Password')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow p-2">
                <div class="card-body">
                    <form action="/user/ganti-password" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Masukkan Password Lama</label> <br>
                            <input id="name" type="password" name="old_password" class="form-control password_input_1" name="old_password"
                                id="old_password">
                            <a href="javascript:;" class="preview_icon_1">Tampilkan Kata Sandi</a>
                            @error('old_password')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Masukkan Password Baru</label> <br>
                            <input id="name" type="password" name="new_password" class="form-control password_input_2" name="new_password"
                                id="new_password">
                            <a href="javascript:;" class="preview_icon_2">Tampilkan Kata Sandi</a>
                            @error('new_password')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Ulangi Password</label> <br>
                            <input id="name" type="password" name="confirmation_password" class="form-control password_input_3"
                                name="confirmation_password" id="confirmation_password">
                            <a href="javascript:;" class="preview_icon_3">Tampilkan Kata Sandi</a>
                            @error('confirmation_password')<p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-send"></i>
                                    Ganti Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const PASSWORD = 'password'
    const TEXT = 'text'
    const passwordIcon1 = document.querySelector('.preview_icon_1')
    const passwordField1 = document.querySelector('.password_input_1')
    const passwordIcon2 = document.querySelector('.preview_icon_2')
    const passwordField2 = document.querySelector('.password_input_2')
    const passwordIcon3 = document.querySelector('.preview_icon_3')
    const passwordField3 = document.querySelector('.password_input_3')
    
    function togglePassword1 () {
        if (passwordField1.type === PASSWORD) {
            passwordField1.type = TEXT
        } else {
            passwordField1.type = PASSWORD
        } 
    }

    function togglePassword2 () {
        if (passwordField2.type === PASSWORD) {
            passwordField2.type = TEXT
        } else {
            passwordField2.type = PASSWORD
        } 
    }

    function togglePassword3 () {
        if (passwordField3.type === PASSWORD) {
            passwordField3.type = TEXT
        } else {
            passwordField3.type = PASSWORD
        } 
    }

    passwordIcon1.addEventListener('click', togglePassword1);
    passwordIcon2.addEventListener('click', togglePassword2);
    passwordIcon3.addEventListener('click', togglePassword3);
</script>
@endsection