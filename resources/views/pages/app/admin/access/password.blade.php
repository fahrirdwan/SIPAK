@extends('layouts.default')

@section('title','Memperbarui Password Akun')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/admin/user-access/password/{{ $id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Password Baru</label> <br>
                            <input type="password" name="new_password" class="form-control">
                            @error('new_password')<p class="text-danger">{{ $message }}</p> @enderror
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