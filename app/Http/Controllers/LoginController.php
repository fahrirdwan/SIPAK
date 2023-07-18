<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman login
    public function login(){
        return view('login');
    }

    // 'POST' | Method untuk memproses data login
    public function proses_login(Request $req){
        // Melakukan validasi form email dan password
        $this->validate($req, [
            'email' => 'required',
            'password'=> 'required'
        ]);

        // Logika if else untuk login
        if(auth()->attempt(['email' => $req->email, 'password' => $req->password])){
            return 'berhasil login';
        }else{
            return 'gagal login';
        }
    }
}
