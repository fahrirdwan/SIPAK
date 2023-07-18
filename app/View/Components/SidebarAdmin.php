<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarAdmin extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $category = \DB::table('jenis_barang')->get();
        $hitung_peminjaman = \DB::table('peminjaman')
                                    ->where('status_peminjaman','=', 'Diproses')
                                    ->where('softDelete', 0)
                                    ->count();
        $hitung_pengembalian = \DB::table('pengembalian')
                                    ->where('status_pengembalian','=', 'Proses Pengembalian')
                                    ->where('softDelete', 0)
                                    ->count();
        $hitung_check_kondisi = \DB::table('check_kondisi')->where('softDelete',0)->count();

        return view('components.sidebar-admin', compact('category','hitung_peminjaman','hitung_pengembalian','hitung_check_kondisi'));
    }
}
