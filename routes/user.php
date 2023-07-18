<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\ExtensionController;
use App\Http\Controllers\User\ListAssetController;
use App\Http\Controllers\User\PeminjamanController;
use App\Http\Controllers\User\PengembalianController;
use App\Http\Controllers\User\GantiPasswordController;

Route::middleware('isUser')->group(function(){
    Route::prefix('user')->group(function(){
        Route::redirect('/','/user/dashboard');
        Route::get('/dashboard', [HomeController::class, 'index']);
        Route::get('/info-rekan', [ExtensionController::class, 'index']);
        Route::get('/profil', [ProfilController::class, 'index']);
        Route::post('/update-profil', [ProfilController::class, 'update']);
        Route::get('/ganti-password', [GantiPasswordController::class, 'index']);
        Route::post('/ganti-password', [GantiPasswordController::class, 'update']);

        // Peminjaman
        Route::get('/peminjaman', [PeminjamanController::class, 'index']);
        Route::get('/peminjaman/cari', [PeminjamanController::class, 'search']);
        Route::get('/peminjaman/tambah-data', [PeminjamanController::class, 'create']);
        Route::get('/peminjaman/tambah-data/{id}',[PeminjamanController::class,'tambah_id']);
        Route::post('/peminjaman/tambah-data', [PeminjamanController::class, 'store']);
        Route::get('/peminjaman/show', [PeminjamanController::class, 'show']);
        Route::get('/peminjaman/detail-peminjaman/{id_peminjaman}', [PeminjamanController::class, 'detail_peminjaman']);
        Route::delete('/peminjaman/{id_barang}', [PeminjamanController::class, 'destroy']);
        Route::post('/kembalikan-barang/{id_peminjaman}', [PengembalianController::class, 'store']);

        // Pengembalian
        Route::get('/pengembalian', [PengembalianController::class, 'index']);
        Route::get('/pengembalian/cari', [PengembalianController::class, 'search']);
        Route::get('/pengembalian/show', [PengembalianController::class, 'show']);
        Route::get('/pengembalian/barang/{id_pengembalian}', [PengembalianController::class, 'update']);
        Route::get('/pengembalian/tambah-data', [PengembalianController::class, 'create']);
        Route::post('/pengembalian/tambah-data', [PengembalianController::class, 'store']);
        
        // History
        Route::get('/history', [HistoryController::class, 'index']);

        // Chat
        Route::get('/chat', [ChatController::class, 'index']);
        Route::post('/chat/store', [ChatController::class, 'store_topic']);
        Route::get('/chat/session/{session_chat}', [ChatController::class, 'create_chat']);
        Route::get('/chat/linked_session/{session_chat}', [ChatController::class, 'create_linked_chat']);
        Route::post('/chat/session/{session_chat}', [ChatController::class, 'store_chat']);
        Route::get('/chat/{name}/{session_chat}', [ChatController::class, 'create_topic']);
                
        // Kategori Asset
        Route::get('/{jenis_barang}', [ListAssetController::class, 'kategori_barang']);
        Route::get('/list-asset/detail/{id_barang}', [ListAssetController::class, 'detail']);
    });
});