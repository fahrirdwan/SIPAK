<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use App\Exports\CheckKondisiExport;
use App\Exports\PengembalianExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Plugin 1 : Laravel Excel
 * Website 1 : https://laravel-excel.com/
 * Plugin 2 : Laravel DomPDF
 * Website 2 : https://github.com/barryvdh/laravel-dompdf
 */
class LaporanController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman laporan
    public function index() 
    {
        $menu = 'Laporan';
        // Halaman laporan di resources/views/pages/app/admin/laporan/index
        return view('pages.app.admin.laporan.index', compact('menu'));
    }

    public function download(Request $req)
    {
        $from = Carbon::parse($req->from_date)->format('Y-m-d');
        $to = Carbon::parse($req->to_date)->format('Y-m-d');
        $from_2 = Carbon::parse($req->from_date)->format('d F Y');
        $to_2 = Carbon::parse($req->to_date)->format('d F Y');

        if($req->type_file === 'PDF')
        {
            if($req->jenis_laporan === 'peminjaman'){
                $peminjaman = \DB::table('peminjaman')
                            ->whereBetween('peminjaman.created_at', [$from, $to])
                            ->join('pengembalian','pengembalian.no_antrian','=','peminjaman.no_antrian')
                            ->join('users','users.nip','=','peminjaman.nip')
                            ->join('barang','barang.id_barang','=','peminjaman.id_barang')
                            ->select('users.name','barang.nama_barang','barang.serial_number','barang.nomor_model','barang.detail','peminjaman.*','pengembalian.status_pengembalian')
                            ->get();
                // Extract data ke PDF
                $pdf = \PDF::loadview('pdf.peminjaman', compact('peminjaman'));
                // Download data ke PDF
                return $pdf->download('Laporan Peminjaman Aset '.date('d F Y').'.pdf');
            }elseif($req->jenis_laporan === 'pengembalian'){
                $from = Carbon::parse($req->from_date)->format('Y-m-d');
                $to = Carbon::parse($req->to_date)->format('Y-m-d');

                $pengembalian = \DB::table('pengembalian')
                            ->whereBetween('pengembalian.created_at', [$from, $to])
                            ->join('users','users.nip','=','pengembalian.nip')
                            ->join('barang','barang.id_barang','=','pengembalian.id_barang')
                            ->select('users.name','barang.nama_barang','barang.serial_number','pengembalian.*')
                            ->get(); 
                // Extract data ke PDF
                $pdf = \PDF::loadview('pdf.pengembalian', compact('pengembalian'));
                // Download data ke PDF
                return $pdf->download('Laporan Pengembalian Aset '.date('d F Y').'.pdf');
            }elseif($req->jenis_laporan === 'check_kondisi'){
                $check_kondisi = \DB::table('check_kondisi')
                            ->whereBetween('check_kondisi.created_at', [$from, $to])
                            ->join('users','users.nip','=','check_kondisi.nip')
                            ->join('barang','barang.id_barang','=','check_kondisi.id_barang')
                            ->select('users.name','barang.nama_barang','barang.serial_number','check_kondisi.*')
                            ->get();
                // Extract data ke PDF
                $pdf = \PDF::loadview('pdf.check_kondisi', compact('check_kondisi'));
                // Download data ke PDF
                return $pdf->download('Laporan Check Kondisi Aset '.date('d F Y').'.pdf');
            }else{
                $histories = \DB::table('history')
                            ->whereBetween('history.created_at', [$from_2, $to_2])
                            ->join('users','users.nip','=','history.nip')
                            ->join('barang','barang.id_barang','=','history.id_barang')
                            ->join('jenis_barang','jenis_barang.id_jenis_barang','=','barang.id_jenis_barang')
                            ->join('check_kondisi','check_kondisi.no_antrian','=','history.no_antrian')
                            ->select('users.name','barang.nama_barang','barang.nomor_model','barang.detail','jenis_barang.jenis_barang','barang.serial_number','history.*','check_kondisi.kondisi_barang')
                            ->get();
                // Extract data ke PDF
                $pdf = \PDF::loadview('pdf.history', compact('histories'));
                // Download data ke PDF
                return $pdf->download('Laporan History '.date('d F Y').'.pdf');
            }
        }elseif($req->type_file === 'Excel'){
            if($req->jenis_laporan === 'peminjaman'){
                return Excel::download(new PeminjamanExport($from, $to), 'data_peminjaman.xlsx'); 
            }elseif($req->jenis_laporan === 'pengembalian'){
                return Excel::download(new PengembalianExport($from, $to), 'data_pengembalian.xlsx');
            }else{
                return Excel::download(new CheckKondisiExport($from, $to), 'data_check_kondisi.xlsx');
            }
        }

        return redirect()->back()->withToastSuccess('Berhasil download data!');
    }

    /**
     * 'GET'
     * Export data peminjaman 
     * Menggunakan plugin DomPDF
     */
    public function pdf_peminjaman() 
    {
        $peminjaman = \DB::table('peminjaman')
                            ->join('users','users.nip','=','peminjaman.nip')
                            ->join('barang','barang.id_barang','=','peminjaman.id_barang')
                            ->select('users.name','barang.nama_barang','barang.serial_number','peminjaman.*')
                            ->get();
        // Extract data ke PDF
	    $pdf = \PDF::loadview('exports.peminjaman', ['peminjaman' => $peminjaman]);
        // Download data ke PDF
	    return $pdf->download('Laporan Peminjaman Aset '.date('d F Y').'.pdf');
    }

    /**
     * 'GET'
     * Export data peminjaman 
     * Menggunakan plugin Excel
     */
    public function exc_peminjaman() 
    {
        // Download data to excel
        return Excel::download(new PeminjamanExport, 'data_peminjaman.xlsx');
    }

    /**
     * 'GET'
     * Export data pengembalian 
     * Menggunakan plugin DomPDF
     */
    public function pdf_pengembalian() 
    {
        $pengembalian = \DB::table('pengembalian')
                            ->join('users','users.nip','=','pengembalian.nip')
                            ->join('barang','barang.id_barang','=','pengembalian.id_barang')
                            ->select('users.name','barang.nama_barang','barang.serial_number','pengembalian.*')
                            ->get(); 
        // Extract data ke PDF
	    $pdf = \PDF::loadview('exports.pengembalian', ['pengembalian' => $pengembalian]);
        // Download data ke PDF
	    return $pdf->download('Laporan Pengembalian Aset '.date('d F Y').'.pdf');
    }

    /**
     * 'GET'
     * Export data pengembalian
     * Menggunakan plugin Excel
     */
    public function exc_pengembalian() 
    {
        // Download data to excel
        return Excel::download(new PengembalianExport, 'data_pengembalian.xlsx');
    }
    
    /**
     * 'GET'
     * Export data check kondisi 
     * Menggunakan plugin DomPDF
     */
    public function pdf_check_kondisi() 
    {
        $check_kondisi = \DB::table('check_kondisi')
                            ->join('users','users.nip','=','check_kondisi.nip')
                            ->join('barang','barang.id_barang','=','check_kondisi.id_barang')
                            ->select('users.name','barang.nama_barang','barang.serial_number','check_kondisi.*')
                            ->get();
        // Extract data ke PDF
	    $pdf = \PDF::loadview('exports.check_kondisi', ['check_kondisi' => $check_kondisi]);
        // Download data ke PDF
	    return $pdf->download('Laporan Check Kondisi Aset '.date('d F Y').'.pdf');
    }

    /**
     * 'GET'
     * Export data check kondisi 
     * Menggunakan plugin Excel
     */
    public function exc_check_kondisi() 
    {
        // Download data to excel
        return Excel::download(new CheckKondisiExport, 'data_check_kondisi.xlsx');
    }

    /**
     * 'GET'
     * Export data check kondisi 
     * Menggunakan plugin DomPDF
     */
    public function pdf_history() 
    {
        $check_kondisi = \DB::table('history')
                            ->join('users','users.nip','=','history.nip')
                            ->join('barang','barang.id_barang','=','history.id_barang')
                            ->select('users.name','barang.nama_barang','barang.serial_number','history.*')
                            ->get();
        // Extract data ke PDF
	    $pdf = \PDF::loadview('exports.history', ['history' => $history]);
        // Download data ke PDF
	    return $pdf->download('Laporan Check Kondisi Aset '.date('d F Y').'.pdf');
    }

    /**
     * 'GET'
     * Export data check kondisi 
     * Menggunakan plugin Excel
     */
    public function exc_history() 
    {
        // Download data to excel
        return Excel::download(new CheckKondisiExport, 'data_check_kondisi.xlsx');
    }
}
