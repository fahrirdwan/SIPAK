@extends('layouts.default')

@section('title','Edit Check Kondisi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="/admin/check-kondisi/edit/{{ $check->id_check_kondisi }}" method="POST">@csrf
                        <label>Note Kondisi Barang</label>
                        <textarea rows="15" cols="50" class="form-control" name="kondisi_barang">{{ $check->kondisi_barang }}</textarea>
                        @error('kondisi_barang')<p class="text-danger">{{ $message }}</p>@enderror
                        <button class="btn btn-success mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection