<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jenis_barang')->insert([
            'id_jenis_barang' => 1,
            'jenis_barang' => 'Laptop'
        ]);
    }
}
