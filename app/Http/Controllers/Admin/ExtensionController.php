<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman extension
    public function index() 
    {
        $menu = 'Kegiatan';
        // Halaman extension di resources/views/pages/app/admin/extension/index
        return view('pages.app.admin.extension.index', compact('menu'));
    }
}
