<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman peminjaman index
    public function index()
    {
        $menu = 'Peminjaman';
        $cari = null;
        /**
         * $peminjaman menampilkan data pada table peminjaman
         * Mengurutkan data berdasarkan data terbaru
         * Inner join pada tabel users, barang
         * Paginasi per halaman = 10 data
         */
        $peminjaman = \DB::table('peminjaman')
                        ->where('peminjaman.nip', Auth::user()->nip)
                        ->orderByDesc('id_peminjaman')
                        ->join('users', 'users.nip', '=', 'peminjaman.nip')
                        ->join('barang', 'barang.id_barang', '=', 'peminjaman.id_barang')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->select('users.name', 'barang.nama_barang', 'barang.serial_number', 'barang.nomor_model', 'barang.detail', 'peminjaman.*', 'jenis_barang.*')
                        ->paginate(10);

        // Halaman peminjaman index di resources/views/pages/app/user/peminjaman/index
        return view('pages.app.user.peminjaman.index', compact('menu','peminjaman','cari'));
    }

    // 'GET' | Method untuk menampilkan halaman detail peminjaman
    public function show()
    {
        $menu = 'Detail Peminjaman';

        // Halaman detail peminjaman di resources/views/pages/app/user/peminjaman/show
        return view('pages.app.user.peminjaman.show', compact('menu'));
    }

    // 'GET' | Method untuk menampilkan halaman tambah peminjaman
    public function create()
    {
        $menu = 'Tambah Data Peminjaman';
        // Jika status_barang 1 artinya barang ready atau dapat dipinjam
        $barang = \DB::table('barang')
                        ->where('status_barang', 1)
                        ->get();

        // Halaman tambah peminjaman di resources/views/pages/app/user/peminjaman/create
        return view('pages.app.user.peminjaman.create', compact('menu','barang'));
    }

    public function tambah_id($id)
    {
        $menu = 'Tambah Data Peminjaman';
        // Jika status_barang 1 artinya barang ready atau dapat dipinjam
        $barang = \DB::table('barang')
                        ->where('status_barang', 1)
                        ->where('id_barang', $id)
                        ->first();

        // Halaman tambah peminjaman di resources/views/pages/app/user/peminjaman/create
        return view('pages.app.user.peminjaman.create_id', compact('menu','barang'));
    }

    // 'POST' | Method untuk menambahkan data (Create) peminjaman
    public function store(Request $req)
    {
        $this->validate($req,[
            'id_barang' => 'required', 
            'angka' => 'required', 
            'jangka_pinjam' => 'required', 
            'created_at' => 'required', 
        ]);
        
        $total_hari = $req->angka * $req->jangka_pinjam;
        // Membuat format 
        $tgl_peminjaman = \Carbon\Carbon::createFromFormat('Y-m-d', $req->created_at);
        // Manipulasi waktu berdasarkan hari
        $durasi = $tgl_peminjaman->addDays($total_hari);
        // Parsing menjadi format d F Y (ex. 01 January 2023) 
        $tgl_pengembalian = \Carbon\Carbon::parse($durasi)->format('Y-m-d');

        $no_antrian = rand(0,10000000);

        // Menambahkan data pada table peminjaman
        $peminjaman = \DB::table('peminjaman')->insert([
            'nip' => Auth::user()->nip,
            'id_barang' => $req->id_barang,
            'no_antrian' => $no_antrian,
            'durasi_peminjaman' => $total_hari,
            'status_peminjaman' => 'Diproses',
            'confirmed' => 0,
            'softDelete' => 0,
            'created_at' => $req->created_at,
            'updated_at' => $req->created_at
        ]);

        $pengembalian = \DB::table('pengembalian')->insert([
            'nip' => Auth::user()->nip,
            'id_barang' => $req->id_barang,
            'no_antrian' => $no_antrian,
            'status_pengembalian' => 'Proses Pengembalian',
            'confirmed' => 0,
            'softDelete' => 1,
            'created_at' => $tgl_pengembalian
        ]);

        // Menambahkan data pada table check_kondisi
        $check_kondisi = \DB::table('check_kondisi')
                            ->insert([
                                'nip' => Auth::user()->nip,
                                'id_barang' => $req->id_barang,
                                'no_antrian' => $no_antrian,
                                'kondisi_barang' => '-',
                                'created_at' => date('Y-m-d', strtotime(now())),
                                'updated_at' => date('Y-m-d', strtotime(now())),
                            ]);
                            
        $barang = \DB::table('barang')
                        ->where('id_barang', $req->id_barang)
                        ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                        ->select('barang.*','jenis_barang.*')
                        ->first();
        
                        // Membuat Data History 
        $history = \DB::table('history')->insert([
            'nip' => Auth::user()->nip,
            'id_barang' => $req->id_barang,
            'no_antrian' => $no_antrian,
            'status' => 'Diproses',
            'pesan' => 'Anda telah mengajukan peminjaman '.$barang->jenis_barang.' '.$barang->nama_barang.'('.$barang->serial_number.')',
            'tgl_peminjaman' => \Carbon\Carbon::parse($req->created_at)->format('d F Y'),
            'tgl_pengembalian' => $tgl_pengembalian,
            'created_at' => date('d F Y'),
            'updated_at' => date('d F Y')
        ]);

        // Redirect ke user peminjaman dan menampilkan notifikasi
        return redirect('/user/peminjaman')->withSuccess('Berhasil Meminjam Barang!');
    }

    // 'GET' | Method untuk menghapus data (Destroy) peminjaman
    public function destroy($id_peminjaman)
    {
        // Menghapus data peminjaman berdasarkan id_peminjaman
        $destroy_peminjaman = \DB::table('peminjaman')->where('id_peminjaman', $id_peminjaman)->delete();
        $destroy_pengembalian = \DB::table('pengembalian')->where('id_pengembalian', $id_peminjaman)->delete();
        $destroy_check_kondisi = \DB::table('check_kondisi')->where('id_check_kondisi', $id_peminjaman)->delete();
        $destroy_history = \DB::table('history')->where('id_history', $id_peminjaman)->delete();

        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withSuccess('Berhasil Hapus Data!');
    }

    public function detail_peminjaman($id_peminjaman){
        $menu = 'Detail Peminjam';
        $barang = \DB::table('barang')
                        ->where('id_barang', $id_peminjaman)
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->select('barang.*', 'jenis_barang.jenis_barang')
                        ->first();

        return view('pages/app/user/peminjaman/detail_peminjaman', compact('menu', 'barang'));
    }
}
