<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExtensionController;
use App\Http\Controllers\Admin\ListAssetController;
use App\Http\Controllers\Admin\PembatalanController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\UserAccessController;
use App\Http\Controllers\Admin\JenisBarangController;
use App\Http\Controllers\Admin\CheckKondisiController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\GantiPasswordController;

Route::middleware('isAdmin')->group(function(){
    Route::prefix('admin')->group(function(){
        Route::redirect('/','/admin/dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/profil', [ProfilController::class, 'index']);
        Route::post('/update-profil', [ProfilController::class, 'update']);
        Route::get('/ganti-password', [GantiPasswordController::class, 'index']);
        Route::post('/ganti-password', [GantiPasswordController::class, 'update']);
        
        // List Asset
        Route::get('/list-asset', [ListAssetController::class, 'index']);
        Route::get('/list-asset/tambah-data', [ListAssetController::class, 'tambah_data']);
        Route::post('/list-asset/tambah-data', [ListAssetController::class, 'proses_tambah']);
        Route::get('/list-asset/detail/{id_barang}', [ListAssetController::class, 'detail']);
        Route::get('/list-asset/edit/{id_barang}', [ListAssetController::class, 'edit']);
        Route::post('/list-asset/edit-data/{id_barang}', [ListAssetController::class, 'edit_data']);
        Route::get('/list-asset/hapus/{id_barang}', [ListAssetController::class, 'hapus']);
        
        // Jenis Barang
        Route::get('/jenis_barang', [JenisBarangController::class, 'jenis_barang']);
        Route::get('/jenis-barang/tambah-data', [JenisBarangController::class, 'tambah_data']);
        Route::post('/jenis-barang/tambah-data', [JenisBarangController::class, 'proses_tambah']);
        Route::get('/jenis-barang/hapus/{id_jenis_barang}', [JenisBarangController::class, 'hapus']);
        Route::get('/jenis-barang/edit/{id_barang}', [JenisBarangController::class, 'edit']);
        Route::post('/jenis-barang/edit-data/{id_barang}', [JenisBarangController::class, 'edit_data']);
        
        // Peminjaman
        Route::get('/peminjaman', [PeminjamanController::class, 'index']);
        Route::get('/peminjaman/cari', [PeminjamanController::class, 'search']);
        Route::get('/peminjaman/tambah',[PeminjamanController::class,'tambah']);
        Route::post('/peminjaman/tambah',[PeminjamanController::class,'tambah_data']);
        Route::get('/peminjaman/approval/{id_peminjaman}', [PeminjamanController::class, 'approval']);
        Route::get('/peminjaman/un-approval/{id_peminjaman}', [PeminjamanController::class, 'un_approval']);
        Route::get('/peminjaman/edit/{id_peminjaman}', [PeminjamanController::class, 'edit']);
        Route::post('/peminjaman/edit/{id_peminjaman}', [PeminjamanController::class, 'edit_data']);
        Route::get('/peminjaman/hapus/{id_peminjaman}', [PeminjamanController::class, 'hapus']);
        Route::get('/peminjaman/detail/{id_peminjaman}', [PeminjamanController::class, 'detail']);
        Route::get('/peminjaman/surat/{id_peminjaman}', [PeminjamanController::class, 'surat']);
                
        // Extension
        Route::get('/info-rekan', [ExtensionController::class, 'index']);
        
        // Pengembalian
        Route::get('/pengembalian', [PengembalianController::class, 'index']);
        Route::get('/pengembalian/cari', [PengembalianController::class, 'search']);
        Route::get('/pengembalian/approval/{id_pengembalian}', [PengembalianController::class, 'approval']);
        Route::get('/pengembalian/un-approval/{id_pengembalian}', [PengembalianController::class, 'un_approval']);
        Route::get('/pengembalian/detail/{id_pengembalian}', [PengembalianController::class, 'detail']);
        Route::get('/pengembalian/hapus/{id_pengembalian}', [PengembalianController::class, 'hapus']);
        Route::get('/pengembalian/surat/{id_pengembalian}', [PengembalianController::class, 'surat']);
        
        // Check Kondisi
        Route::get('/check-kondisi', [CheckKondisiController::class, 'index']);
        Route::get('/check-kondisi/edit/{id_check_kondisi}', [CheckKondisiController::class, 'edit']);
        Route::post('/check-kondisi/edit/{id_check_kondisi}', [CheckKondisiController::class, 'edit_data']);
        Route::get('/check-kondisi/hapus/{id_check_kondisi}', [CheckKondisiController::class, 'hapus_data']);
        
        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index']);
        Route::post('/download/laporan', [LaporanController::class, 'download']);
        Route::get('/download/laporan/pdf/peminjaman', [LaporanController::class, 'pdf_peminjaman']);
        Route::get('/download/laporan/excel/peminjaman', [LaporanController::class, 'exc_peminjaman']);
        Route::get('/download/laporan/pdf/pengembalian', [LaporanController::class, 'pdf_pengembalian']);
        Route::get('/download/laporan/excel/pengembalian', [LaporanController::class, 'exc_pengembalian']);
        Route::get('/download/laporan/pdf/check-kondisi', [LaporanController::class, 'pdf_check_kondisi']);
        Route::get('/download/laporan/excel/check-kondisi', [LaporanController::class, 'exc_check_kondisi']);
        Route::get('/download/laporan/pdf/history', [LaporanController::class, 'exc_history']);
        Route::get('/download/laporan/excel/history', [LaporanController::class, 'exc_history']);
        
        // User Access
        Route::get('/user-access', [UserAccessController::class, 'index']);
        Route::get('/user-access/create', [UserAccessController::class, 'create']);
        Route::post('/user-access/store', [UserAccessController::class, 'store']);
        Route::get('/user-access/password/{id}', [UserAccessController::class, 'pass_edit']);
        Route::post('/user-access/password/{id}', [UserAccessController::class, 'pass_update']);
        Route::get('/user-access/edit/{id}', [UserAccessController::class, 'edit']);
        Route::post('/user-access/update/{id}', [UserAccessController::class, 'update']);
        Route::get('/user-access/delete/{id}', [UserAccessController::class, 'destroy']);
        
        //History Admin
        Route::get('/history', [HistoryController::class, 'index']);

        // Chat
        Route::get('/chat', [ChatController::class, 'index']);
        Route::post('/chat/store', [ChatController::class, 'store_topic']);
        Route::get('/chat/session/{session_chat}', [ChatController::class, 'create_chat']);
        Route::get('/chat/linked_session/{session_chat}', [ChatController::class, 'create_linked_chat']);
        Route::post('/chat/session/{session_chat}', [ChatController::class, 'store_chat']);
        Route::get('/chat/{name}/{session_chat}', [ChatController::class, 'create_topic']);

        // Pembatalan
        Route::get('/pembatalan', [PembatalanController::class, 'index']);
        Route::get('/pembatalan-peminjaman/un-approval/{id_peminjaman}', [PembatalanController::class, 'un_approval_peminjaman']);
        Route::get('/pembatalan-pengembalian/un-approval/{id_pengembalian}', [PembatalanController::class, 'un_approval_pengembalian']);

        // Jenis Barang
        Route::get('/{jenis_barang}', [ListAssetController::class, 'kategori_barang']);
        Route::get('/{jenis_barang}/tambah-data', [ListAssetController::class, 'tambah_data_kategori']);
        Route::post('/{jenis_barang}/tambah-data', [ListAssetController::class, 'proses_tambah_data_kategori']);
        Route::get('/{jenis_barang}/hapus/{id_barang}', [ListAssetController::class, 'hapus_kategori']);
        Route::get('/{jenis_barang}/edit/{id_barang}', [ListAssetController::class, 'edit_kategori']);
        Route::post('/{jenis_barang}/edit-data/{id_barang}', [ListAssetController::class, 'edit_data_kategori']);
    });
});