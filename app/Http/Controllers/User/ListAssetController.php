<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListAssetController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman kategori barang
    public function kategori_barang($jenis_barang)
    {
        $menu = $jenis_barang;
        $jenis_bg = $jenis_barang;

        /**
         * $barang menampilkan data pada table barang
         * Mengurutkan data berdasarkan data terbaru
         * Inner join pada table jenis_barang
         */
        $barang = \DB::table('barang')
                        ->where(['jenis_barang' => $jenis_barang, 'status_barang' => 1])
                        ->orderByDesc('serial_number')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->get();
                        
        $jenis_brg = \DB::table('jenis_barang')
                        ->where('jenis_barang', $jenis_barang)
                        ->first();

        // Halaman kategori barang di resources/views/pages/app/user/list_assets/kategori_barang
        return view('pages.app.user.list_assets.kategori_barang', compact('menu','barang', 'jenis_brg', 'jenis_bg'));
    }
    public function detail($serial_number)
    {
        $menu = 'Detail Peminjam';
        $barang = \DB::table('barang')
                        ->where('serial_number', $serial_number)
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->select('barang.*', 'jenis_barang.jenis_barang')
                        ->first();
        // Halaman detail aset di resources/views/pages/app/admin/list_assets/detail_data                
        return view('pages.app.user.list_assets.detail_data', compact('menu','barang'));
    }
}
