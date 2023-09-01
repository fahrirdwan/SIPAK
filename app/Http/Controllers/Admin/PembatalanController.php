<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembatalanController extends Controller
{
    public function index()
    {
        $menu='Data Pembatalan Transaksi';
        $peminjaman = \DB::table('peminjaman')
                            ->where('peminjaman.softDelete', 1)
                            ->orderBy('created_at')
                            ->join('users', 'users.nip', '=', 'peminjaman.nip')
                            ->join('barang', 'barang.serial_number', '=', 'peminjaman.serial_number')
                            ->join('pengembalian', 'pengembalian.no_antrian', '=', 'peminjaman.no_antrian')
                            ->select('users.name', 'barang.nama_barang', 'barang.serial_number','barang.nomor_model','barang.detail','barang.status_barang', 'peminjaman.*','pengembalian.status_pengembalian')
                            ->get();
        $pengembalian = \DB::table('pengembalian')
                            ->where('pengembalian.softDelete', 1)
                            ->orderBy('created_at')
                            ->join('users', 'users.nip', '=', 'pengembalian.nip')
                            ->join('barang', 'barang.serial_number', '=', 'pengembalian.serial_number')
                            ->join('peminjaman', 'peminjaman.no_antrian', '=', 'pengembalian.no_antrian')
                            ->join('check_kondisi', 'check_kondisi.no_antrian', '=', 'peminjaman.no_antrian')
                            ->select('users.name', 'barang.nama_barang', 'barang.serial_number','barang.nomor_model','barang.detail','barang.status_barang', 'pengembalian.*','peminjaman.status_peminjaman','check_kondisi.kondisi_barang')
                            ->get();
        return view('pages.app.admin.pembatalan.index', compact('menu','peminjaman','pengembalian'));
    }

    // 'GET' | Method untuk membatalkan persetujuan peminjaman barang
    /**
     * Dibuat apabila pihak admin salah pencet
     * atau kesalahan penginputan data
     */
    public function un_approval_peminjaman($id_peminjaman)
    {
        $peminjaman = \DB::table('peminjaman')->where('id_peminjaman', $id_peminjaman)->first();
        // Memperbarui peminjaman berdasarkan id
        $update_peminjaman = \DB::table('peminjaman')
                                ->where('id_peminjaman', $id_peminjaman)
                                ->update([
                                    'confirmed' => 0,
                                    'softDelete' => 0,
                                    'status_peminjaman' => 'Diproses',
                                    'updated_at' => date('Y-m-d')
                                ]);
        $update_pengembalian = \DB::table('pengembalian')
        ->where('id_pengembalian', $id_peminjaman)
        ->update([
            'softDelete' => 1,
        ]);
        // Memperbarui status barang
        /**
         * Jika status barang = 1
         * Artinya barang ready dan
         * dapat dipinjam oleh user
         */
        $status_barang = \DB::table('barang')->where('serial_number', $peminjaman->serial_number)->update([
            'status_barang' => 1
        ]);

        $barang = \DB::table('barang')
                        ->where('serial_number', $peminjaman->serial_number)
                        ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                        ->select('barang.*','jenis_barang.*')
                        ->first();
                        
        // Membuat Data History 
        $history = \DB::table('history')->where('no_antrian', $peminjaman->no_antrian)->update([
            'nip' => $peminjaman->nip,
            'serial_number' => $peminjaman->serial_number,
            'status' => 'Diproses',
            'pesan' => 'Anda telah mengajukan peminjaman '.$barang->jenis_barang.' '.$barang->nama_barang.'('.$barang->serial_number.')',
            'updated_at' => date('d F Y')
        ]);

        // Redirect ke halaman yang sama dan menampilkan notifikasi 
        return redirect()->back()->withToastSuccess('Berhasil membatalkan Persetujuan peminjaman!');
    }

    // 'GET' | Method untuk membatalkan persetujuan pengembalian barang
    /**
     * Dibuat apabila pihak admin salah pencet
     * atau kesalahan penginputan data
     */
    public function un_approval_pengembalian($id_pengembalian)
    {
        $barang = \DB::table('pengembalian')->where('id_pengembalian', $id_pengembalian)->first();
        // Memperbarui pengembalian berdasarkan id
        $update = \DB::table('pengembalian')
                        ->where('id_pengembalian', $id_pengembalian)
                        ->update([
                            'confirmed' => 0,
                            'softDelete' => 0,
                            'status_pengembalian' => 'Proses Pengembalian',
                            'updated_at' => date('Y-m-d')
                        ]);

        $check_kondisi = \DB::table('check_kondisi')
            ->where('no_antrian', $barang->no_antrian)
            ->update(['softDelete' => 1]);

        // Memperbarui status barang
        /**
         * Jika status barang = 0
         * Artinya barang telah dipinjam dan
         * tidak dapat dipinjam oleh user
         */
        $status_barang = \DB::table('barang')->where('serial_number', $barang->serial_number)->update([
            'status_barang' => 0
        ]);

        $get_barang = \DB::table('barang')
                        ->where('serial_number', $barang->serial_number)
                        ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                        ->select('barang.*','jenis_barang.*')
                        ->first();

        // Membuat Data History 
        $history = \DB::table('history')->where('no_antrian', $barang->no_antrian)->update([
            'nip' => $barang->nip,
            'serial_number' => $barang->serial_number,
            'status' => 'Proses Pengembalian',
            'pesan' => 'Anda telah mengajukan pengembalian '.$get_barang->jenis_barang.' '.$get_barang->nama_barang.'('.$get_barang->serial_number.')',
            'updated_at' => date('d F Y')
        ]);        

        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withToastSuccess('Berhasil membatalkan Persetujuan pengembalian!');
    }
}
