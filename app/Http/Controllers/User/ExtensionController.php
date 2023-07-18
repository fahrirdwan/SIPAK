<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman ekstensi
    public function index()
    {
        $menu = 'Kegiatan';

        // Halaman extension index di resources/pages/views/pages/app/user/extension/index
        return view('pages.app.user.extension.index', compact('menu'));
    }
}
