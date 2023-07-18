<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class SidebarUser extends Component
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
        $hitung_peminjaman = \DB::table('peminjaman')->where(['nip' => Auth::user()->nip, 'status_peminjaman' => 'Diproses'])->count();
        $hitung_pengembalian = \DB::table('pengembalian')->where(['nip' => Auth::user()->nip, 'status_pengembalian' => 'Proses Pengembalian'])->count();
        $hitung_history = \DB::table('history')->where('nip', Auth::user()->nip)->count();

        return view('components.sidebar-user', compact('category','hitung_peminjaman','hitung_pengembalian','hitung_history'));
    }
}
