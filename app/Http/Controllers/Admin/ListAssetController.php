<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

/**
 * Plugin : Intervention/Image
 * Website : https://image.intervention.io/
 */
class ListAssetController extends Controller
{
    // 'GET' | Method untuk menampilkan halaman list aset
    public function index() 
    {
        $menu = 'List Asset';
        $barang = \DB::table('barang')
                        ->orderByDesc('id_barang')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->get();
        // Halaman list aset di resources/views/pages/app/admin/list_assets/index
        return view('pages.app.admin.list_assets.index', compact('menu','barang'));
    }

    /**
     * 'GET' | Method untuk menampilkan halaman detail list aset
     * berdasarkan id
     */
    public function detail($id_barang)
    {
        $menu = 'Detail Peminjam';
        $barang = \DB::table('barang')
                        ->where('id_barang', $id_barang)
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->select('barang.*', 'jenis_barang.jenis_barang')
                        ->first();
        // Halaman detail aset di resources/views/pages/app/admin/list_assets/detail_data                
        return view('pages.app.admin.list_assets.detail_data', compact('menu','barang'));
    }

    // 'GET' | Method untuk menampilkan halaman tambah aset
    public function tambah_data()
    {
        $menu = 'Tambah Aset';
        $jenis_barang = \DB::table('jenis_barang')->get();
        // Halaman tambah aset di resources/views/pages/app/admin/list_assets/tambah_data
        return view('pages.app.admin.list_assets.tambah_data', compact('menu','jenis_barang'));
    }

    // 'POST | Method untuk menambah barang
    public function proses_tambah(Request $req)
    {
        /**
         * Validasi pada form input :
         * nomor_model, nama_barang, 
         * serial_number, id_jenis_barang,
         * detail, gambar
         */
        $this->validate($req, [
           'nomor_model' => 'required|unique:barang',  
           'nama_barang' => 'required', 
           'serial_number' => 'required|unique:barang',
           'id_jenis_barang' => 'required',  
           'detail' => 'required',  
           'gambar' => 'required',  
        ]);

        $file = $req->file('gambar');
        // Manipulasi foto
        $imanip = Image::make($file);
        // Simpan foto ke folder public/img/aset
        $imanip->save('img/aset/'.$file->getClientOriginalName());
        // Menambah data barang
        $store = \DB::table('barang')->insert([
                        'nomor_model' => $req->nomor_model,  
                        'nama_barang' => $req->nama_barang,  
                        'serial_number' => $req->serial_number,  
                        'id_jenis_barang' => $req->id_jenis_barang,  
                        'gambar' => $file->getClientOriginalName(),
                        'detail' => $req->detail, 
                        'status_barang' => 1, 
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]);
        // Redirect ke halaman lsit asset dan menampilkan notifikasi
        return redirect('/admin/list-asset')->withSuccess('Berhasil menambah data');
    }

    // 'GET' | Method untuk menghapus barang berdasarkan id
    public function hapus($id_barang)
    {
        $destroy = \DB::table('barang')->where('id_barang', $id_barang)->delete();
        // Redirect ke halaman yang sama dan menampilkan notifikasi
        return redirect()->back()->withSuccess('Berhasil Hapus Data');
    }

    // 'GET' | Method untuk menampilkan halaman edit barang berdasarkan id
    public function edit($id_barang)
    {
        $menu = 'Edit Data';
        $barang = \DB::table('barang')
                        ->where('id_barang', $id_barang)
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->first();
        $jenis_barang = \DB::table('jenis_barang')->get();
        // Halaman edit barang di resources/views/pages/app/admin/list_assets/edit_data
        return view('pages.app.admin.list_assets.edit_data', compact('menu','barang', 'jenis_barang'));
    }
    
    // 'POST' | Method untuk memperbarui barang berdasarkan id
    public function edit_data(Request $req, $id_barang)
    {
        /**
         * Validasi form input :
         * nomor_model, nama_barang, 
         * id_jenis_barang, detail
         */
        $this->validate($req, [
           'nomor_model' => 'required',  
           'nama_barang' => 'required',  
           'id_jenis_barang' => 'required',  
           'detail' => 'required',  
        ]);
        // Logika memperbarui barang
        if($req->hasFile('gambar'))
        {
            // Jika admin memperbarui foto barang, jalankan kode
            $file = $req->file('gambar');
            // Manipulasi foto
            $imanip = Image::make($file)->resize(600, 300);
            // Simpan foto ke folder public/img/aset
            $imanip->save('img/aset/'. $file->getClientOriginalName());
            // Memperbarui barang
            $update = \DB::table('barang')->where('id_barang', $id_barang)
                        ->update([
                            'nomor_model' => $req->nomor_model,  
                            'nama_barang' => $req->nama_barang,  
                            'id_jenis_barang' => $req->id_jenis_barang,  
                            'gambar' => $file->getClientOriginalName(),
                            'detail' => $req->detail,  
                            'updated_at' => now(),
                    ]);
        }else{
            // Jika admin tidak memperbarui foto barang, jalankan kode
            $update = \DB::table('barang')->where('id_barang', $id_barang)
                        ->update([
                            'nomor_model' => $req->nomor_model,  
                            'nama_barang' => $req->nama_barang,  
                            'id_jenis_barang' => $req->id_jenis_barang,  
                            'detail' => $req->detail,  
                            'updated_at' => now(),
                        ]);
        }
        // Redirect ke halaman list aset dan menampilkan notifikasi
        return redirect('/admin/list-asset')->withSuccess('berhasil mengedit data');
    }
    
    // ==============================================================================
    // Method dibawah sama dengan sebelumnya, 
    // CRUD sesuai dengan $jenis_barang yang dipilih
    // ==============================================================================
    public function kategori_barang($jenis_barang)
    {
        $menu = $jenis_barang;
        $jenis_bg = $jenis_barang;
        $barang = \DB::table('barang')
                        ->where('jenis_barang', $jenis_barang)
                        ->orderByDesc('id_barang')
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')
                        ->get();
        $jenis_brg = \DB::table('jenis_barang')
                        ->where('jenis_barang', $jenis_barang)
                        ->first();
        return view('pages.app.admin.list_assets.kategori_barang', compact('menu','barang', 'jenis_brg', 'jenis_bg'));
    }

    public function tambah_data_kategori($jenis_barang)
    {
        $menu = 'Tambah Data';
        $jenis_bg = $jenis_barang;
        $jenis_brg = \DB::table('jenis_barang')->get();

        return view('pages.app.admin.list_assets.tambah_data_kategori', compact('menu','jenis_brg', 'jenis_bg'));
    }

    public function proses_tambah_data_kategori(Request $req, $jenis_barang)
    {
        $this->validate($req, [
           'nomor_model' => 'required',  
           'serial_number' => 'required',  
           'nama_barang' => 'required',  
           'id_jenis_barang' => 'required',  
           'gambar' => 'required',  
           'detail' => 'required',  
        ]);
        
        $file = $req->file('gambar');
        $file ->move('img/aset/', $file->getClientOriginalName());
        \DB::table('barang')->insert([
            'nomor_model' => $req->nomor_model,  
            'serial_number' => $req->serial_number,  
            'nama_barang' => $req->nama_barang,  
            'id_jenis_barang' => $req->id_jenis_barang,  
            'gambar' => $file->getClientOriginalName(),
            'detail' => $req->detail,
            'status_barang' => 1,  
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        
        return redirect('/admin/'. $jenis_barang)->withSuccess('berhasil menambah data');
    }

    public function hapus_kategori($jenis_barang, $id_barang)
    {
        \DB::table('barang')->where('id_barang', $id_barang)->delete();
        return redirect('/admin/'. $jenis_barang)->withSuccess('Berhasil Hapus Data');
    }
    
    public function edit_kategori($jenis_barang, $id_barang)
    {
        $menu = 'Edit Data';
        $jenis_bg = $jenis_barang;
        $barang = \DB::table('barang')
                        ->where('id_barang', $id_barang)
                        ->join('jenis_barang', 'jenis_barang.id_jenis_barang', '=', 'barang.id_jenis_barang')  
                        ->first();
        $jenis_barang = \DB::table('jenis_barang')->get();

        return view('pages.app.admin.list_assets.edit_data_kategori', compact('menu','barang', 'jenis_barang', 'jenis_bg'));
    }
    public function edit_data_kategori(Request $req, $jenis_barang, $id_barang)
    {
        $this->validate($req, [
           'nomor_model' => 'required',  
           'nama_barang' => 'required',  
           'id_jenis_barang' => 'required',  
           'detail' => 'required',  
        ]);

        if($req->hasFile('gambar'))
        {
            $file = $req->file('gambar');
            $file ->move('img/aset/', $file->getClientOriginalName());
            \DB::table('barang')->where('id_barang', $id_barang)
            ->update([
                'nomor_model' => $req->nomor_model,  
                'serial_number' => $req->serial_number,  
                'nama_barang' => $req->nama_barang,  
                'id_jenis_barang' => $req->id_jenis_barang,  
                'gambar' => $file->getClientOriginalName(),
                'detail' => $req->detail,  
                'updated_at' => now(),
            ]);
        }else{
            \DB::table('barang')->where('id_barang', $id_barang)
            ->update([
                'nomor_model' => $req->nomor_model,  
                'serial_number' => $req->nomor_model,  
                'nama_barang' => $req->nama_barang,  
                'id_jenis_barang' => $req->id_jenis_barang,  
                'detail' => $req->detail,  
                'updated_at' => now(),
            ]);
        }

        return redirect('/admin/'. $jenis_barang)->withSuccess('berhasil mengedit data');
    }
}
