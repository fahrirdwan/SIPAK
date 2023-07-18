<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PeminjamanExport implements FromView
{
    private $from;
    private $to;

    public function __construct($from,$to) 
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        $peminjaman = \DB::table('peminjaman')
                            ->whereBetween('peminjaman.created_at', [$this->from, $this->to])
                            ->join('users','users.nip','=','peminjaman.nip')
                            ->join('barang','barang.id_barang','=','peminjaman.id_barang')
                            ->join('pengembalian','pengembalian.no_antrian','=','peminjaman.no_antrian')
                            ->select('users.name','barang.nama_barang','barang.nomor_model','barang.detail','barang.serial_number','peminjaman.*','pengembalian.status_pengembalian')
                            ->get();

        return view('exports.peminjaman', compact('peminjaman'));
    }
}
