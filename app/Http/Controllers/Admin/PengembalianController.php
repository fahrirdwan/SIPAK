<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengembalianController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman pengembalian barang
    public function index()
    {
        $menu = 'Pengembalian';
        $cari = null;
        /**
         * $pengembalian untuk menampilkan data pengembalian
         * Mengurutkan data berdasarkan data terbaru
         * Inner join pada table users, barang
         * Paginasi per halaman = 10 data
         */
        $pengembalian = \DB::table('pengembalian')
                        ->orderBy('created_at')
                        ->where('pengembalian.softDelete', 0)
                        ->join('users', 'users.nip', '=', 'pengembalian.nip')
                        ->join('barang', 'barang.id_barang', '=', 'pengembalian.id_barang')
                        ->join('peminjaman','peminjaman.no_antrian','=','pengembalian.no_antrian')
                        ->select('users.name', 'barang.nama_barang', 'barang.serial_number','barang.nomor_model','barang.detail', 'pengembalian.*','peminjaman.status_peminjaman')
                        ->get(); 
        // Halaman pengembalian di resources/views/pages/app/admin/pengembalian/index
        return view('pages.app.admin.pengembalian.index', compact('menu','pengembalian','cari'));
    }

    // 'GET' | Method untuk menampilkan halaman detail pengembalian
    public function detail($id_pengembalian)
    {
        $menu = 'Detail Pengembalian';
        $pengembalian = \DB::table('pengembalian')
                        ->orderByDesc('id_pengembalian')
                        ->join('users', 'users.nip', '=', 'pengembalian.nip')
                        ->join('barang', 'barang.id_barang', '=', 'pengembalian.id_barang')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->select('users.name','users.nip', 'users.email', 'users.jabatan', 'users.phone_number', 'users.picture', 'barang.nama_barang', 'barang.gambar', 'barang.serial_number', 'barang.detail', 'jenis_barang.jenis_barang', 'pengembalian.*')
                        ->first();
        // Halaman detail pengembalian di resources/views/pages/app/admin/pengembalian/detail
        return view('pages.app.admin.pengembalian.detail', compact('menu','pengembalian'));
    }

    // 'GET' | Method untuk menghapus pengembalian berdasarkan id
    public function hapus($id_pengembalian)
    {
        // Menghapus pengembalian barang
        $destroy_pengembalian = \DB::table('pengembalian')->where('id_pengembalian', $id_pengembalian)->delete();
        $destroy_peminjaman = \DB::table('peminjaman')->where('id_peminjaman', $id_pengembalian)->delete();
        $destroy_check_kondisi = \DB::table('check_kondisi')->where('id_check_kondisi', $id_pengembalian)->delete();
        $destroy_history = \DB::table('history')->where('id_history', $id_pengembalian)->delete();

        // Redirect ke halaman yang sama
        return redirect()->back()->withSuccess('Berhasil Hapus Data');
    }

    // 'GET' | Method untuk menyetujui pengembalian barang
    /**
     * Note : Jika status pengembalian = 1
     * Artinya barang sudah ditangan admin
     */
    public function approval($id_pengembalian)
    {
        $barang = \DB::table('pengembalian')->where('id_pengembalian', $id_pengembalian)->first();
        // Memperbarui pengembalian berdasarkan id
        $update = \DB::table('pengembalian')
                        ->where('id_pengembalian', $id_pengembalian)
                        ->update([
                            'confirmed' => 1,
                            'softDelete' => 1,
                            'status_pengembalian' => 'Dikembalikan',
                            'updated_at' => date('Y-m-d')
                        ]);
        
        // Memperbarui status barang 
        /**
         * Jika status barang = 1
         * Artinya barang ready dan
         * dapat dipinjam oleh user
         */
        $status_barang = \DB::table('barang')->where('id_barang', $barang->id_barang)->update([
            'status_barang' => 1
        ]);

        $get_barang = \DB::table('barang')
                        ->where('id_barang', $barang->id_barang)
                        ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                        ->select('barang.*','jenis_barang.*')
                        ->first();

        // Membuat Data History 
        $history = \DB::table('history')->where('no_antrian', $barang->no_antrian)->update([
            'nip' => $barang->nip,
            'id_barang' => $barang->id_barang,
            'status' => 'Dikembalikan',
            'pesan' => 'Pengembalian '.$get_barang->jenis_barang.' '.$get_barang->nama_barang.'('.$get_barang->serial_number.')'.' anda telah disetujui',
            'updated_at' => date('d F Y')
        ]);
        
        // Menambahkan data pada table check_kondisi
        $check_kondisi = \DB::table('check_kondisi')
                            ->where('no_antrian', $barang->no_antrian)
                            ->update(['softDelete' => 0]);

        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect('/admin/check-kondisi')->withToastSuccess('Berhasil approval pengembalian!');
    }

    

    public function surat($id_pengembalian)
    {
        $pengembalian = \DB::table('pengembalian')
                        ->where('id_pengembalian', $id_pengembalian)
                        ->join('users', 'users.nip', '=', 'pengembalian.nip')
                        ->join('barang', 'barang.id_barang', '=', 'pengembalian.id_barang')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->join('check_kondisi', 'check_kondisi.no_antrian', '=', 'pengembalian.no_antrian')
                        ->select('users.name','users.nip', 'users.email', 'users.jabatan', 'users.phone_number', 'users.picture', 'barang.nama_barang', 'barang.gambar','barang.detail', 'barang.nomor_model','barang.serial_number','jenis_barang.jenis_barang', 'pengembalian.*', 'check_kondisi.kondisi_barang')
                        ->first();

        return view('pages.app.surat_pengembalian', compact('pengembalian'));
    }
}
