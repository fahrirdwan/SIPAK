<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CheckKondisiExport implements FromView
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
        $check_kondisi = \DB::table('check_kondisi')
                            ->whereBetween('check_kondisi.created_at', [$this->from, $this->to])
                            ->join('users','users.nip','=','check_kondisi.nip')
                            ->join('barang','barang.serial_number','=','check_kondisi.serial_number')
                            ->select('users.name','barang.nama_barang','barang.nomor_model','barang.detail','barang.serial_number','check_kondisi.*')
                            ->get();

        return view('exports.check_kondisi', compact('check_kondisi'));
    }
}
