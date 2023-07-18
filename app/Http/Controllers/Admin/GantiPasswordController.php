<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GantiPasswordController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman ganti password
    public function index()
    {
        $menu = 'Ganti Password';
        // Halaman ganti password di resources/views/pages/app/admin/ganti_password
        return view('pages.app.admin.ganti_password', compact('menu'));
    }
    
    // 'POST' | Method untuk memperbarui password
    public function update(Request $req)
    {
        /**
         * Validasi pada form input :
         * old_password, new_password, 
         * confirmation_password
         */
        $this->validate($req, [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirmation_password' => 'required|same:new_password',
        ]);

        // Logika login
        if(auth()->attempt(['email' => Auth::user()->email, 'password' => $req->old_password]))
        {
            // Memperbarui user
            $update = User::where('id', Auth::user()->id)
                            ->update([
                                'password' => \Hash::make($req->new_password)
                            ]);
            // Redirect ke halaman yang sama dan menampilkan notifikasi 
            return redirect()->back()->withToastSuccess('Berhasil memperbarui password');                    
        }else{
            // Redirect ke halaman yang sama dan menampilkan notifikasi 
            return redirect()->back()->withToastWarning('Password yang anda masukan salah');
        }
    }
}
