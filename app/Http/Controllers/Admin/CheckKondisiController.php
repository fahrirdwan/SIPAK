<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckKondisiController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman check kodisi
    public function index() 
    {
        $menu = 'Check Kondisi';
        /**
         * $chek kondisi untuk menampilkan data check kondisi
         * Inner join pada table users, barang
         * Paginasi per halaman = 8 data
         */
        $check_kondisi = \DB::table('check_kondisi')
                            ->where('softDelete', 0)
                            ->join('users','users.nip','=','check_kondisi.nip')
                            ->join('barang','barang.serial_number','=','check_kondisi.serial_number')
                            ->select('users.name','barang.nama_barang','barang.nomor_model','barang.serial_number','check_kondisi.*')
                            ->paginate(8);
        // Halaman check kondisi di resources/views/pages/app/admin/check_kondisi/index
        return view('pages.app.admin.check_kondisi.index', compact('menu','check_kondisi'));
    }

    // 'GET' | Method untuk halaman edit check kondisi berdasarkan id
    public function edit($id_check_kondisi)
    {
        $menu = 'Check Kondisi';
        $check = \DB::table('check_kondisi')
                    ->where(['id_check_kondisi' => $id_check_kondisi])
                    ->join('users','users.nip','=','check_kondisi.nip')
                    ->join('barang','barang.serial_number','=','check_kondisi.serial_number')
                    ->select('users.name','barang.nama_barang','barang.serial_number','check_kondisi.*')
                    ->first();
        // Halaman perbarui check kondisi di resources/views/pages/app/admin/check_kondisi/index
        return view('pages.app.admin.check_kondisi.edit_data', compact('menu','check'));
    }

    // 'POST' | Method untuk memperbarui check kondisi
    public function edit_data(Request $req, $id_check_kondisi)
    {
        $this->validate($req, [
            'kondisi_barang' => 'required|min:4'
        ]);

        $check = \DB::table('check_kondisi')
                    ->where('id_check_kondisi', $id_check_kondisi)
                    ->join('users','users.nip','=','check_kondisi.nip')
                    ->join('barang','barang.serial_number','=','check_kondisi.serial_number')
                    ->select('users.name','barang.nama_barang','check_kondisi.*')
                    ->first();
                    
        // Memperbarui check kondisi
        $check_kondisi = \DB::table('check_kondisi')
                            ->where('id_check_kondisi', $id_check_kondisi)
                            ->update([
                                'nip' => $check->nip,
                                'serial_number' => $check->serial_number,
                                'kondisi_barang' => $req->kondisi_barang,
                                'updated_at' => date('d F Y')
                            ]);
        
        // Menghapus pengembalian
        $pengembalian = \DB::table('pengembalian')
                            ->where('no_antrian', $check->no_antrian)
                            ->update(['softDelete' => 1]);

        // Redirect ke halaman check kondisi dan menampilkan notifikasi
        return redirect('/admin/check-kondisi')->withToastSuccess('Berhasil menambahkan kondisi aset terbaru');
    }
    
    // 'GET' | Method untuk menghapus check kondisi berdasarkan id
    public function hapus_data($id_check_kondisi)
    {
        // Menghapus check kondisi
        $delete = \DB::table('check_kondisi')->where('id_check_kondisi', $id_check_kondisi)->delete();
        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withToastSuccess('Berhasil menghapus check kondisi!');
    }

    public function detail($id_pengembalian)
    {
        $menu = 'Detail Pengembalian';
        $pengembalian = \DB::table('pengembalian')
                        ->orderByDesc('id_pengembalian')
                        ->join('users', 'users.nip', '=', 'pengembalian.nip')
                        ->join('barang', 'barang.serial_number', '=', 'pengembalian.serial_number')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->select('users.name','users.nip', 'users.email', 'users.jabatan', 'users.phone_number', 'users.picture', 'barang.nama_barang', 'barang.gambar', 'barang.serial_number', 'barang.detail', 'jenis_barang.jenis_barang', 'pengembalian.*')
                        ->first();
        // Halaman detail pengembalian di resources/views/pages/app/admin/pengembalian/detail
        return view('pages.app.admin.pengembalian.detail', compact('menu','pengembalian'));
    }
}
