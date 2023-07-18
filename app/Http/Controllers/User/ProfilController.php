<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

/**
 * Plugin : Intervention/Image
 * Website : https://image.intervention.io/
 */
class ProfilController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman profile
    public function index()
    {
        $menu = 'Profil';
        // Mengambil 1 data sesuai dengan id user
        $user = User::where('nip', Auth::user()->nip)->first();

        // Halaman profile di resources/views/pages/app/user/profile
        return view('pages.app.user.profile', compact('menu','user'));
    }

    // 'POST' | Method untuk memperbarui profile
    public function update(Request $req){
        /** 
         * Logika if else memperbarui profile
         * hasFile digunakan untuk memeriksa bila user mengupload file atau tidak
         * */ 
        if($req->hasFile('picture'))
        {
            // Mengambil value input picture
            $file = $req->file('picture');
            // Manipulasi foto 250x250
            $imanip = Image::make($file)->fit(250);
            // Save foto profile ke folder /public/img/profil
            $imanip->save('img/profil/'.$file->getClientOriginalName());
            
            // Update profile berdasarkan id yang dimiliki
            User::where('nip', Auth::user()->nip)
                    ->update([
                        'name'=> $req->name,
                        'nip'=> $req->nip,
                        'tgl_lahir'=> $req->tgl_lahir,
                        'phone_number'=> $req->phone_number,
                        'jabatan'=> $req->jabatan,
                        'picture' => $file->getClientOriginalName(),
                        'updated_at' => now()
                    ]);
        }else{
            // Else dijalankan ketika user tidak memperbarui foto profile
            User::where('nip', Auth::user()->nip)
                    ->update([
                        'name'=> $req->name,
                        'nip'=> $req->nip,
                        'tgl_lahir'=> $req->tgl_lahir,
                        'phone_number'=> $req->phone_number,
                        'jabatan'=> $req->jabatan,
                        'updated_at' => now()
                    ]);
        }

        // Redirect ke halaman yang sama 
        return redirect()->back()->withToastSuccess('Berhasil Edit Profil');
    }
}
