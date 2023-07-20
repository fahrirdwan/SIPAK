<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserAccess;
use App\Http\Controllers\Controller;

class UserAccessController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman user management
    public function index()
    {
        $menu = 'Data Karyawan';
        /** 
         * Menampilkan users dengan id lebih dari 1
         * Mengurutkan data terbaru
         * Paginasi per halaman = 8 data
         */ 
        $users = User::where('id','>', 1)
                        ->orderByDesc('id')
                        ->join('roles','roles.id_role','=','users.id_role')
                        ->paginate(8);

        // Halaman user management di resources/views/pages/app/admin/access/index
        return view('pages.app.admin.access.index', compact('menu','users'));
    }

    // 'GET' | Method untuk menambahkan user 
    public function create()
    {
        $menu = 'Tambah Akun';
        $roles = \DB::table('roles')->get();
        // Halaman menambah user di resources/views/pages/app/admin/access/create
        return view('pages.app.admin.access.create', compact('menu','roles'));
    }

    // 'POST' | Method untuk menambah user
    public function store(Request $req)
    {
        /**
         * Validasi untuk form input :
         * name, username, email
         */
         $validate = $this->validate($req,[
            'name'=>'required',
            'id_role'=>'required',
            'email'=>'required|unique:users',
            'nip'=>'required|unique:users',
        ]);
        $store = User::create(array_merge($validate,[
            'id' => rand(0, 1000),
            'password' => bcrypt('password123'),
            'picture' => 'user.png',
            'tgl_lahir' => $req->tgl_lahir,
            'jabatan' => $req->jabatan,
            'phone_number' => $req->phone_number,
        ]));

        // Redirect ke halaman user management dan menampilkan notifikasi
        return redirect('/admin/user-access')->withToastSuccess('Berhasil tambah akun!');
    }

    // 'GET' | Method untuk memperbarui user berdasarkan id
    public function edit($id)
    {
        $menu = 'Memperbarui Akun';
        $user = User::where('id',$id)
                    ->join('roles','roles.id_role','=','users.id_role')
                    ->first();
        $roles = \DB::table('roles')->get();

        // Halaman memperbarui user di resources/views/pages/app/admin/access/edit
        return view('pages.app.admin.access.edit', compact('menu','user','roles'));
    }

    // 'POST' | Method untuk memperbarui user
    public function update(Request $req, $id)
    {
        /**
         * Validasi untuk form input :
         * name, username, email
         */
        $this->validate($req,[
            'name'=>'required',
            'id_role'=>'required',
            'tgl_lahir'=>'required',
            'phone_number'=>'required',
        ]);

        // Memperbarui user
        $update = User::whereId($id)->update([
            'name' => $req->name,
            'tgl_lahir' => $req->tgl_lahir,
            'jabatan' => $req->jabatan,
            'phone_number' => $req->phone_number,
            'id_role' => $req->id_role,

        ]);
        
        // Redirect ke halaman user management dan menampilkan notifikasi
        return redirect('/admin/user-access')->withToastSuccess('Berhasil memperbarui akun!');
    }

    // 'GET' | Method untuk menghapus user berdasarkan id
    public function destroy($id)
    {
        // Menghapus user
        $delete = User::whereId($id)->delete();
        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withToastSuccess('Berhasil menghapus akun!');
    }

    // 'GET' | Method untuk memperbarui password berdasarkan id
    public function pass_edit($id)
    {
        $menu = 'Memperbarui Password Akun';
        // Halaman memperbarui password user di resources/views/pages/app/admin/access/password
        return view('pages.app.admin.access.password', compact('menu','id'));
    }

    // 'POST' | Method untuk memperbarui password berdasarkan id
    public function pass_update(Request $req, $id)
    {
        // Validasi input new_password
        $this->validate($req, [
            'new_password'
        ]);
        // Memperbarui password user
        $update = \DB::table('users')
                        ->where('id', $id)
                        ->update(['password' => bcrypt($req->new_password)]);

        // Redirect ke halaman user management dan menampilkan notifikasi
        return redirect('/admin/user-access')->withToastSuccess('Berhasil memperbarui password akun!');
    }
}
