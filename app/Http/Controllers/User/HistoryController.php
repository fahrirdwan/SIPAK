<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman history index
    public function index()
    {
        $menu = 'History';
        /**
         * $history menampilkan data pada table history
         * Mengurutkan data berdasarkan data terbaru
         * Paginasi per halaman = 4 data
         */
        $history = \DB::table('history')
                        ->where(['nip' => Auth::user()->nip])
                        ->orderByDesc('id_history')
                        ->join('barang','barang.id_barang','=','history.id_barang')
                        ->select('history.*','barang.gambar')
                        ->paginate(4);

        // Halaman history di resources/views/pages/app/user/history/index
        return view('pages.app.user.history.index', compact('menu','history'));
    }
}
