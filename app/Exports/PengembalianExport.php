<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PengembalianExport implements FromView
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
        $pengembalian = \DB::table('pengembalian')
                            ->whereBetween('pengembalian.created_at', [$this->from, $this->to])
                            ->join('users','users.nip','=','pengembalian.nip')
                            ->join('barang','barang.serial_number','=','pengembalian.serial_number')
                            ->select('users.name','barang.nama_barang','barang.nomor_model','barang.detail','barang.serial_number','pengembalian.*')
                            ->get();

        return view('exports.pengembalian', compact('pengembalian'));
    }
}
