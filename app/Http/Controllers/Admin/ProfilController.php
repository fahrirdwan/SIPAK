<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

/**
 * Plugin : Intervention/Image
 * Website : https://image.intervention.io/
 */
class ProfilController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman profile
    public function index (){
        $menu = 'Profile';
        $user = User::where('id', Auth::user()->id)->first();
        // Halaman profile di resources/views/pages/app/admin/profile
        return view('pages.app.admin.profile', compact('menu','user'));
    }
    
    // 'POST' | Method untuk memperbarui user
    public function update(Request $req){
        // Logika memperbarui user
        if($req->hasFile('picture'))
        {
            // Jika user upload foto, jalankan kode 
            $file = $req->file('picture');
            // Manipulasi foto
            $imanip = Image::make($file)->fit(250);
            // Safe foto ke folder public/img/profil/
            $imanip->save('img/profil/'.$file->getClientOriginalName());

            // Update user berdasarkan id yang dimilikinya
            User::where('id', Auth::user()->id)
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
            // Jika user tidak upload foto, jalankan kode
            // Update user berdasarkan id yang dimilikinya
            User::where('id', Auth::user()->id)
                    ->update([
                        'name'=> $req->name,
                        'nip'=> $req->nip,
                        'tgl_lahir'=> $req->tgl_lahir,
                        'phone_number'=> $req->phone_number,
                        'jabatan'=> $req->jabatan,
                        'updated_at' => now()
                    ]);
        }

        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withToastSuccess('Berhasil Edit Profil');
    }
}
