<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman home
    public function index()
    {
        // Menghitung table users, barang, jenis_barang
        $menu = 'Dashboard';
        $hitung_peminjaman = \DB::table('peminjaman')
                                ->where('peminjaman.nip', Auth::user()->nip)
                                ->where('status_peminjaman', 'Dipinjam')
                                ->where('status_pengembalian', 'Proses Pengembalian')
                                ->join('pengembalian','pengembalian.no_antrian','=','peminjaman.no_antrian')
                                ->count();
        $hitung_pengembalian = \DB::table('pengembalian')
                                ->where('pengembalian.nip', Auth::user()->nip)
                                ->where('status_pengembalian', 'Dikembalikan')
                                    ->count();
        $hitung_barang = \DB::table('barang')->where('status_barang',1)->count();
        $hitung_history = \DB::table('history')
                                ->where('nip', Auth::user()->nip)
                                ->count();

        // Halaman home di resources/views/pages/app/user/dashboard
        return view('pages.app.user.dashboard', compact('menu','hitung_peminjaman','hitung_pengembalian','hitung_barang', 'hitung_history'));
    }
}
