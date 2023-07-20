<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $menu='History transaksi';
        $histories = \DB::table('history')
                        ->orderByDesc('id_history')
                        ->join('users','users.nip','=','history.nip')
                        ->join('barang','barang.id_barang','=','history.id_barang')
                        ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                        ->join('check_kondisi','check_kondisi.no_antrian','=','history.no_antrian')
                        ->select('history.*','users.name','barang.nama_barang','barang.nomor_model','barang.detail','barang.serial_number','jenis_barang.jenis_barang','check_kondisi.kondisi_barang')
                        ->get();
        return view('pages.app.admin.history.index', compact('menu','histories'));
    }
}
