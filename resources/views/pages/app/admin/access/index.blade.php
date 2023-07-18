@extends('layouts.default')

@section('title','User Access')

@section('content')
<div class="container-fluid">
    <a href="/admin/user-access/create" class="btn btn-primary mb-4">Tambah Akun</a>
    <div class="row">
      <div class="col-12">
        <div class="card shadow p-3">
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Akses Sebagai</th>
                    <th>Email</th>
                    <th>Nomor Hp</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <a href="/img/profil/{{ $user->picture }}" data-fancybox>
                            <img src="/img/profil/{{ $user->picture }}" width="40">
                        </a>&nbsp;
                        {{ $user->name }}
                    </td>
                    <td>{{ $user->nip }}</td>
                    <td>{{ $user->name_role }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td class="text-center">
                        <a href="/admin/user-access/password/{{ $user->id }}" class="btn btn-primary"><i class="fas fa-lock"></i></a>&nbsp;
                        <a href="/admin/user-access/edit/{{ $user->id }}" class="btn btn-success"><i class="fas fa-edit"></i></a>&nbsp;
                        <a href="/admin/user-access/delete/{{ $user->id }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div> 
@endsection

