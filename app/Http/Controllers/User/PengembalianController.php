<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman pengembalian 
    public function index()
    {
        $menu = 'Pengembalian';
        $cari = null;
        /**
         * $pengambilan menampilkan data pada tabel pengembalian
         * Mengurutkan data berdasarkan data terbaru
         * Inner join pada tabel users, dan barang
         * Paginasi per halaman =  10 data
         */
        $pengembalian = \DB::table('pengembalian')
                            ->where('pengembalian.nip', Auth::user()->nip)
                            ->orderByDesc('id_pengembalian')
                            ->join('users', 'users.nip', '=', 'pengembalian.nip')
                            ->join('barang', 'barang.id_barang', '=', 'pengembalian.id_barang')
                            ->join('jenis_barang', 'jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                            ->select('users.name', 'barang.nama_barang', 'barang.serial_number', 'barang.nomor_model', 'barang.detail', 'pengembalian.*','jenis_barang.*')
                            ->paginate(10);

        // Halaman pengembalian di resources/views/pages/app/user/pengembalian/index
        return view('pages.app.user.pengembalian.index', compact('menu','pengembalian','cari'));
    }

    // 'GET' | Method untuk menampilkan halaman pencarian
    public function search(Request $req)
    {
        $menu = 'Pengembalian';
        // Menangkap value input pencarian
        $cari = $req->cari;
        /**
         * $pengembalian menampilkan data pada tabel pengembalian
         * Inner join pada table users, barang
         * Paginasi per halaman = 10 data
         */
        $pengembalian = \DB::table('pengembalian')
                        ->orderByDesc('id_pengembalian')
                        ->join('users', 'users.nip', '=', 'pengembalian.nip')
                        ->join('barang', 'barang.id_barang', '=', 'pengembalian.id_barang')
                        ->select('users.name', 'barang.nama_barang', 'barang.serial_number', 'pengembalian.*')
                        ->where('serial_number','like','%'.$cari.'%')
                        ->orwhere('name','like','%'.$cari.'%')
                        ->orwhere('nama_barang','like','%'.$cari.'%')
                        ->orwhere('status_pengembalian','like','%'.$cari.'%')
                        ->paginate(10);

        // Menampilkan data pengembalian berdasarkan value input pencarian
        return view('pages.app.user.pengembalian.index', compact('menu','pengembalian','cari'));
    }

    // 'GET' | Method untuk menampilkan halaman detail pengembalian
    public function show()
    {
        $menu = 'Detail Pengembalian';

        // Halaman detail pengembalian di resources/views/pages/app/user/pengembalian/show
        return view('pages.app.user.pengembalian.show', compact('menu'));
    }

    // 'GET' | Method untuk menampilkan halaman tambah pengembalian
    public function create()
    {
        $menu = 'Tambah Data Pengembalian';
        // Jika confirmed 1 artinya barang telah terpinjam
        $barang = \DB::table('peminjaman')
                        ->where(['confirmed' => 1, 'nip' => Auth::user()->nip])
                        ->join('barang','barang.id_barang','=','peminjaman.id_barang')
                        ->select('peminjaman.*','barang.nama_barang','barang.serial_number')
                        ->get();
        // Halaman tambah pengembalian di resources/views/pages/app/user/pengembalian/create
        return view('pages.app.user.pengembalian.create', compact('menu','barang'));
    }

    // 'POST' | Method untuk menambahkan data (Create) tambah pengembalian
    public function store(Request $req)
    {
        $this->validate($req,[
            'id_barang' => 'required', 
            'created_at' => 'required', 
        ]);
        
        // Menambahkan data pada tabel pengembalian
        $pengembalian = \DB::table('pengembalian')
                            ->updateOrInsert([
                                'nip' => Auth::user()->nip,
                                'id_barang' => $req->id_barang,
                            ],[
                                'nip' => Auth::user()->nip,
                                'id_barang' => $req->id_barang,
                                'status_pengembalian' => 'Diproses',
                                'confirmed' => 0,
                                'created_at' => date('d F Y'),
                                'updated_at' => date('d F Y')
                            ]);
        
        $get_history = \DB::table('history')->where([
            'nip' => Auth::user()->nip,
            'id_barang' => $req->id_barang
        ])->first();
        
        if($get_history->status === 'Dikembalikan'){
            /**
             * Jika status history = Dikembalikan,
             * buat data history baru supaya data lama 
             * tidak tertiban
             */
            $history = \DB::table('history')->insert([
                'nip' => Auth::user()->nip,
                'id_barang' => $req->id_barang,
                'status' => 'Diproses',
                'tgl_peminjaman' => '-',
                'tgl_pengembalian' => '-'
            ]);

        }else{
            // Memperbarui atau membuat history berdasarkan barang yang dikembalikan
            $history = \DB::table('history')->updateOrInsert([
                'nip' => Auth::user()->nip,
                'id_barang' => $req->id_barang,
            ],
            [
                'nip' => Auth::user()->nip,
                'id_barang' => $req->id_barang,
                'status' => 'Proses Pengembalian',
                'tgl_pengembalian' => date('d F Y')
            ]);
        }
        
        // Menambahkan data pada table check_kondisi
        $check_kondisi = \DB::table('check_kondisi')
                            ->insert([
                                'nip' => Auth::user()->nip,
                                'id_barang' => $req->id_barang,
                                'kondisi_barang' => '-',
                                'created_at' => date('Y-m-d', strtotime(now())),
                                'updated_at' => date('Y-m-d', strtotime(now())),
                            ]);
        
        // Redirect ke halaman user pengembalian
        return redirect('/user/pengembalian')->withSuccess('Berhasil mengembalikan barang!');
    }
}
