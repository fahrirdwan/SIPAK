<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman dashboard
    public function index(){
        $menu = 'Dashboard';
        $hitung_user = User::count();
        $hitung_peminjam = \DB::table('peminjaman')
                                ->where('status_peminjaman', 'Dipinjam')
                                ->where('status_pengembalian', 'Proses Pengembalian')
                                ->join('pengembalian','pengembalian.no_antrian','=','peminjaman.no_antrian')
                                ->count();
        $hitung_pengembalian = \DB::table('pengembalian')
                                    ->where('status_pengembalian', 'Dikembalikan')
                                    ->count();
        $hitung_barang_tersedia = \DB::table('barang')->where('status_barang',1)->count();

        // Halaman dashboard di resources/views/pages/app/admin/dashboard
        return view('pages.app.admin.dashboard', compact('menu','hitung_user', 'hitung_peminjam', 'hitung_pengembalian','hitung_barang_tersedia'));
    }
}
