@extends('layouts.default')

@section('title','Laporan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card shadow" style="border-radius: 20px">
                <div class="card-body p-4">
                    <h4>Laporan Check Kondisi</h1><br>
                    <form action="/admin/download/laporan" method="POST">@csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label>Jenis Laporan</label>
                                    <select name="jenis_laporan" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="peminjaman">Peminjaman</option>
                                        <option value="pengembalian">Pengembalian</option>
                                        <option value="check_kondisi">Check Kondisi</option>
                                        <option value="history">Gabungan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label>Tipe File</label>
                                    <select name="type_file" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Excel">Excel</option>
                                        <option value="PDF">PDF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label>Dari Tanggal</label>
                                    <input type="date" class="form-control" name="from_date" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label>Ke Tanggal</label>
                                    <input type="date" class="form-control" name="to_date" required>
                                </div>
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection