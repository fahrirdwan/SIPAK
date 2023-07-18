<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index(){
        $hitung_user = \DB::table('users')->count();
        return view('index', compact('hitung_user'));
    }
}
