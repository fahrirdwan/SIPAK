<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GabunganExport implements FromView
{
    private $from_2;
    private $to_2;

    public function __construct($from_2,$to_2) 
    {
        $this->from_2 = $from_2;
        $this->to_2 = $to_2;
    }

    public function view(): View
    {
        $histories = \DB::table('history')
                            ->whereBetween('history.created_at', [$from_2, $to_2])
                            ->join('users','users.nip','=','history.nip')
                            ->join('barang','barang.serial_number','=','history.serial_number')
                            ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                            ->join('check_kondisi','check_kondisi.no_antrian','=','history.no_antrian')
                            ->select('users.name','barang.nama_barang','barang.nomor_model','barang.detail','jenis_barang.jenis_barang','barang.serial_number','history.*','check_kondisi.kondisi_barang')
                            ->get();

        return view('exports.history', compact('histories'));
    }
}
