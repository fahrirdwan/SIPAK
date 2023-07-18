<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman registrasi 
    public function register(){
        return view('register');
    }

    // 'POST' | Method untuk memproses registrasi
    public function proses_register(Request $req){
        /** 
         * Melakukan validasi form input 
         * nama lengkap, email, password
        */ 
        $this->validate($req, [
            'nama_lengkap' => 'required',
            'email' => 'required',
            'password'=> 'required'
        ]);

        // Menambahkan data ke table users
        \DB::table('users')->insert([
            'nama_lengkap' => $req->nama_lengkap,
            'email' => $req->email,
            'password'=> \Hash::make($req->password)
        ]);

        // Redirect ke url http://localhost:8000/login
        return redirect('login');
    }

}
