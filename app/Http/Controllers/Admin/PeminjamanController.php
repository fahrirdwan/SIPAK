<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman peminjaman barang
    public function index()
    {
        $menu = 'Peminjaman';
        $cari = null;
        /**
         * $peminjaman untuk menampilkan data peminjaman
         * Mengurutkan data berdasarkan data terbaru
         * Inner join pada table users, barang
         * Paginasi per halaman = 10 data
         */
        $peminjaman = \DB::table('peminjaman')
                        ->where('status_peminjaman','!=','Dikembalikan')
                        ->where('peminjaman.softDelete', 0)
                        ->orderBy('created_at')
                        ->join('users', 'users.nip', '=', 'peminjaman.nip')
                        ->join('barang', 'barang.id_barang', '=', 'peminjaman.id_barang')
                        ->join('pengembalian', 'pengembalian.no_antrian', '=', 'peminjaman.no_antrian')
                        ->select('users.name', 'barang.nama_barang', 'barang.serial_number','barang.nomor_model','barang.detail','barang.status_barang', 'peminjaman.*','pengembalian.status_pengembalian')
                        ->get();
        // Halaman peminjaman di resources/views/pages/app/admin/peminjaman/index
        return view('pages.app.admin.peminjaman.index', compact('menu','peminjaman','cari'));
    }

    // 'GET' | Method untuk menghapus peminjaman berdasarkan id
    public function hapus($id_peminjaman)
    {
        // Menghapus peminjaman
        $destroy_peminjaman = \DB::table('peminjaman')->where('id_peminjaman', $id_peminjaman)->delete();
        $destroy_pengembalian = \DB::table('pengembalian')->where('id_pengembalian', $id_peminjaman)->delete();
        $destroy_check_kondisi = \DB::table('check_kondisi')->where('id_check_kondisi', $id_peminjaman)->delete();
        $destroy_history = \DB::table('history')->where('id_history', $id_peminjaman)->delete();
        
        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withSuccess('Berhasil Hapus Data');
    }

    // 'GET' | Method untuk menampilkan halaman detail peminjaman
    public function detail($id_peminjaman)
    {
        $menu = 'Detail Peminjam';
        $peminjaman = \DB::table('peminjaman')
                        ->orderByDesc('id_peminjaman')
                        ->join('users', 'users.nip', '=', 'peminjaman.nip')
                        ->join('barang', 'barang.id_barang', '=', 'peminjaman.id_barang')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->select('users.name','users.nip', 'users.email', 'users.jabatan', 'users.phone_number', 'users.picture', 'barang.nama_barang', 'barang.gambar','barang.detail', 'barang.nomor_model','barang.serial_number','jenis_barang.jenis_barang', 'peminjaman.*')
                        ->first();
        // Halaman detail peminjaman di resources/views/pages/app/admin/peminjaman/detail                
        return view('pages.app.admin.peminjaman.detail', compact('menu','peminjaman'));
    }

    // 'GET' | Method untuk menyetujui peminjaman barang
    /**
     * Note : Jika status peminjaman = 1
     * Artinya user dapat langsung mengambil 
     * barang yang ingin dipinjam
     */
    public function approval($id_peminjaman)
    {
        $peminjaman = \DB::table('peminjaman')->where('id_peminjaman', $id_peminjaman)->first();
        // Memperbarui peminjaman berdasarkan id
        $update = \DB::table('peminjaman')
                        ->where('id_peminjaman', $id_peminjaman)
                        ->update([
                            'confirmed' => 1,
                            'softDelete' => 1,
                            'status_peminjaman' => 'Dipinjam',
                            'updated_at' => date('Y-m-d')
                        ]);
        $update_pengembalian = \DB::table('pengembalian')
                                    ->where('id_pengembalian', $id_peminjaman)
                                    ->update([
                                      'softDelete' => 0,
        ]);
        // Memperbarui status barang 
        /**
         * Jika status barang = 0
         * Artinya barang telah dipinjam dan
         * tidak dapat dipinjam oleh user
         */
        $status_barang = \DB::table('barang')->where('id_barang', $peminjaman->id_barang)->update([
            'status_barang' => 0
        ]);

        $barang = \DB::table('barang')
                        ->where('id_barang', $peminjaman->id_barang)
                        ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                        ->select('barang.*','jenis_barang.*')
                        ->first();

        // Membuat Data History 
        $history = \DB::table('history')->where('no_antrian', $peminjaman->no_antrian)->update([
            'nip' => $peminjaman->nip,
            'id_barang' => $peminjaman->id_barang,
            'status' => 'Dipinjam',
            'pesan' => 'Peminjaman '.$barang->jenis_barang.' '.$barang->nama_barang.'('.$barang->serial_number.')'.' anda telah disetujui',
            'updated_at' => date('d F Y')
        ]);

        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withToastSuccess('Berhasil approval peminjaman!');
    }

    // 'GET' | Method untuk menampilkan halaman tambah peminjaman
    public function tambah()
    {
        $menu='peminjaman';
        $users = \DB::table('users')->get();
        $barang = \DB::table('barang')
                        ->where('status_barang', 1)
                        ->get();
        // Halaman tambah peminjaman di resources/views/pages/app/admin/peminjaman/tambah_data
        return view('pages.app.admin.peminjaman.tambah_data', compact('menu','users','barang'));
    }

    // 'POST' | Method untuk menambah peminjaman barang
    public function tambah_data(Request $req)
    {
        /**
         * Validasi form input :
         * id_user, id_barang, durasi_peminjaman
         * status_peminjaman, created_at
         */
        $this->validate($req, [
            'nip' => 'required',
            'id_barang' => 'required',
            'angka' => 'required',
            'jangka_pinjam' => 'required',
            'created_at' => 'required',
        ]);


        $total_hari = $req->angka * $req->jangka_pinjam;

        $tgl_peminjaman = \Carbon\Carbon::createFromFormat('Y-m-d', $req->created_at);
        // Manipulasi waktu berdasarkan hari
        $durasi = $tgl_peminjaman->addDays($total_hari);
        // Parsing menjadi format Y-m-d (ex. 2023-01-01) 
        $tgl_pengembalian = \Carbon\Carbon::parse($durasi)->format('Y-m-d');

        $no_antrian = rand(0,10000000);
        // Menambahkan peminjaman barang
        $peminjaman = \DB::table('peminjaman')->insert([
            'nip' => $req->nip,
            'id_barang' => $req->id_barang,
            'no_antrian' => $no_antrian,
            'durasi_peminjaman' => $total_hari,
            'status_peminjaman' => 'Diproses',
            'confirmed' => 0,
            'softDelete'=> 0,
            'created_at' => $req->created_at,
            'updated_at' => $req->created_at
        ]);

        $pengembalian = \DB::table('pengembalian')->insert([
            'nip' => $req->nip,
            'id_barang' => $req->id_barang,
            'no_antrian' => $no_antrian,
            'status_pengembalian' => 'Proses Pengembalian',
            'confirmed' => 0,
            'softDelete' => 0,
            'created_at' => $tgl_pengembalian
        ]);

        $barang = \DB::table('barang')
                        ->where('id_barang', $req->id_barang)
                        ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                        ->select('barang.*','jenis_barang.*')
                        ->first();
        
        // Membuat Data History 
        $history = \DB::table('history')->insert([
            'nip' => $req->nip,
            'id_barang' => $req->id_barang,
            'no_antrian' => $no_antrian,
            'status' => 'Diproses',
            'pesan' => 'Anda telah mengajukan peminjaman '.$barang->jenis_barang.' '.$barang->nama_barang.'('.$barang->serial_number.')',
            'tgl_peminjaman' => \Carbon\Carbon::parse($req->created_at)->format('d F Y'),
            'tgl_pengembalian' => $tgl_pengembalian,
            'created_at' => date('d F Y'),
            'updated_at' => date('d F Y')
        ]);

        // Menambahkan data pada table check_kondisi
        $check_kondisi = \DB::table('check_kondisi')
                            ->insert([
                                'nip' => $req->nip,
                                'id_barang' => $req->id_barang,
                                'no_antrian' => $no_antrian,
                                'kondisi_barang' => '-',
                                'softDelete' => 1,  
                                'created_at' => date('Y-m-d', strtotime(now())),
                                'updated_at' => date('Y-m-d', strtotime(now())),
                            ]);

        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect('/admin/peminjaman')->withToastSuccess('Berhasil menambah peminjam!');
    }

    // 'GET' | Method untuk menampilkan halaman perbarui peminjaman berdasarkan id
    public function edit($id_peminjaman)
    {
        $menu='peminjaman';
        $users = \DB::table('users')->get();
        $barang = \DB::table('barang')->get();
        $peminjaman = \DB::table('peminjaman')
                            ->where('id_peminjaman', $id_peminjaman)
                            ->join('users','users.nip','=','peminjaman.nip')
                            ->join('barang','barang.id_barang','=','peminjaman.id_barang')
                            ->select('users.name','barang.nama_barang','peminjaman.*')
                            ->first();
        // Halaman edit peminjaman di resources/views/pages/app/admin/peminjaman/edit_data
        return view('pages.app.admin.peminjaman.edit_data', compact('menu','users','barang','peminjaman'));
    }

    // 'POST' | Method untuk memperbarui peminjaman barang berdasarkan id
    public function edit_data(Request $req, $id_peminjaman)
    {
        /**
         * Validasi form input :
         * id_user, id_barang, durasi_peminjaman
         * status_peminjaman, created_at,
         * updated_at
         */
        $this->validate($req, [
            'id_barang' => 'required',
            'durasi_peminjaman' => 'required',
            'status_peminjaman' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
        ]);
        
        $dikembalikan = \DB::table('peminjaman')
                            ->where('id_peminjaman', $id_peminjaman)
                            ->first();
        // Memperbarui peminjaman barang
        $peminjaman = \DB::table('peminjaman')
                        ->where('id_peminjaman', $id_peminjaman)
                        ->update([
                            'id_barang' => $req->id_barang,
                            'durasi_peminjaman' => $req->durasi_peminjaman,
                            'created_at' => date('Y-m-d', strtotime($req->created_at)),
                            'status_peminjaman' => $req->status_peminjaman,
                            'updated_at' => date('Y-m-d', strtotime($req->updated_at)),
                        ]);
        // Memperbarui atau menambahkan history
        $history = \DB::table('history')->updateOrInsert([
            'nip' => $dikembalikan->nip,
            'id_barang' => $req->id_barang,
        ],
        [
            'nip' => $dikembalikan->nip,
            'id_barang' => $req->id_barang,
            'status' => $req->status_peminjaman,
            'tgl_peminjaman' => date('d F Y', strtotime($req->created_at)),
            'tgl_pengembalian' => '-'
        ]);

        if($req->status_peminjaman === 'Dikembalikan'){
            // Menambah data pengembalian barang
            $pengembalian = \DB::table('pengembalian')
                    ->insert([
                        'nip' => $dikembalikan->nip,
                        'id_barang' => $req->id_barang,
                        'status_pengembalian' => $req->status_peminjaman,
                        'created_at' => date('Y-m-d', strtotime($req->created_at)),
                        'updated_at' => date('Y-m-d', strtotime($req->updated_at)),
                    ]);
            
            // Menambah data check kondisi
            $check_kondisi = \DB::table('check_kondisi')
                    ->insert([
                        'nip' => $dikembalikan->nip,
                        'id_barang' => $req->id_barang,
                        'kondisi_barang' => '-',
                        'created_at' => date('d F Y', strtotime($req->created_at)),
                        'updated_at' => date('d F Y', strtotime($req->updated_at)),
                    ]);
            
            // Memperbarui atau menambahkan history
            $history = \DB::table('history')->updateOrInsert([
                'nip' => $dikembalikan->nip,
                'id_barang' => $req->id_barang,
            ],
            [
                'nip' => $dikembalikan->nip,
                'id_barang' => $req->id_barang,
                'status' => $req->status_peminjaman,
                'tgl_peminjaman' => date('d F Y', strtotime($req->created_at)),
                'tgl_pengembalian' => date('d F Y', strtotime($req->updated_at))
            ]);
        }
        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withToastSuccess('Berhasil memperbarui peminjam!');
    }

    public function surat($id_peminjaman)
    {
        $peminjaman = \DB::table('peminjaman')
                        ->orderByDesc('id_peminjaman')
                        ->join('users', 'users.nip', '=', 'peminjaman.nip')
                        ->join('barang', 'barang.id_barang', '=', 'peminjaman.id_barang')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->join('pengembalian', 'pengembalian.no_antrian', '=', 'peminjaman.no_antrian')
                        ->select('users.name','users.nip', 'users.email', 'users.jabatan', 'users.phone_number', 'users.picture', 'barang.nama_barang', 'barang.gambar','barang.detail', 'barang.nomor_model','barang.serial_number','jenis_barang.jenis_barang', 'pengembalian.created_at as tgl_pengembalian', 'peminjaman.*')
                        ->first();

        return view('pages.app.surat_keterangan', compact('peminjaman'));
    }
}
