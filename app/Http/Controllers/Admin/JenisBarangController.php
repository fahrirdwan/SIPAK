<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman jenis barang
    public function jenis_barang() 
    {
        $menu = 'Jenis Barang';
        $barang = \DB::table('jenis_barang')
                        ->orderByDesc('id_jenis_barang')
                        ->get();
        // Halaman jenis barang di resources/views/pages/app/admin/jenis_barang/index
        return view('pages.app.admin.jenis_barang.index', compact('menu','barang'));
    }

    // 'GET' | Method untuk menampilkan halaman tambah jenis barang
    public function tambah_data()
    {
        $menu = 'Tambah Jenis Barang';
        $jenis_barang = \DB::table('jenis_barang')->get();
        // Halaman tambah jenis barang di resources/views/pages/app/admin/jenis_barang/tambah_data
        return view('pages.app.admin.jenis_barang.tambah_data', compact('menu','jenis_barang'));
    }

    // 'POST' | Method untuk menambah jenis barang
    public function proses_tambah(Request $req)
    {
        // Validasi form input jenis_barang
        $this->validate($req, [
           'jenis_barang' => 'required|unique:jenis_barang',  
        ]);
        // Menambahkan jenis barang
        $store = \DB::table('jenis_barang')->insert([
                    'jenis_barang' => $req->jenis_barang,  
                ]);
        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect('/admin/jenis_barang')->withSuccess('Berhasil Menambah Jenis Aset');
    }

    // 'GET' | Method untuk menghapus jenis barang berdasarkan id
    public function hapus($id_jenis_barang)
    {
        // Menghapus jenis barang
        $destroy = \DB::table('jenis_barang')->where('id_jenis_barang', $id_jenis_barang)->delete();
        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withSuccess('Berhasil Hapus Data');
    }

    // 'GET' | Method untuk menampilkan halaman edit jenis barang berdasarkan id
    public function edit($id_jenis_barang)
    {
        $menu = 'Edit Barang';
        $barang = \DB::table('jenis_barang')->where('id_jenis_barang', $id_jenis_barang)->first();
        // Halaman edit jenis barang di resources/views/pages/app/admin/jenis_barang/edit_data
        return view('pages.app.admin.jenis_barang.edit_data', compact('menu','barang'));
    }

    // 'POST' | Method untuk memperbarui jenis barang berdasarkan id
    public function edit_data(Request $req, $id_jenis_barang)
    {
        // Validasi form input jenis_barang
        $this->validate($req, [
           'jenis_barang' => 'required',  
        ]);

        $update = \DB::table('jenis_barang')->where('id_jenis_barang', $id_jenis_barang)
                    ->update([
                    'jenis_barang' => $req->jenis_barang,  
                    ]);
        // Redirect ke halaman jenis barang dan menampilkan notifikasi
        return redirect('/admin/jenis_barang')->withSuccess('Berhasil mengedit jenis Barang');
    }
}
