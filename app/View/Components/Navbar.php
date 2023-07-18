<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
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
        $data['notif_keluar'] = \DB::table('history')
                            ->where([
                                'nip' => auth()->user()->nip, 
                                'status' => 'Dipinjam',
                                'softDelete' => NULL
                            ])
                            ->join('barang','barang.id_barang','=','history.id_barang')
                            ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                            ->select('history.*','barang.nama_barang','jenis_barang.jenis_barang')
                            ->limit(4)->get();
        
        return view('components.navbar', $data);
    }
}
