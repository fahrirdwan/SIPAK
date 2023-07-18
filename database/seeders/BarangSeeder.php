<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('barang')->insert([
            'id_barang' => 1,
            'nomor_model' => 'X441BA',
            'nama_barang' => 'ASUS X441BA',
            'id_jenis_barang' => 1,
            'serial_number' => 'A1B2C3D4E5',
            'detail' => '<p>HDD 1TB, RAM 4GB</p>',
            'gambar' => 'laptop.png',
            'status_barang' => 1
        ]);
    }
}
