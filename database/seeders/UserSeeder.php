<?php

namespace Database\Seeders;

use File;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/users.json');
        $users = json_decode($json);

        foreach($users as $user){
            \DB::table('users')->insert([
                'id' => $user->id,
                'name' => $user->name,
                'nip' => $user->nip,
                'email' => $user->email,
                'password' => $user->password,
                'picture' => $user->picture,
                'id_role' => $user->id_role
            ]);
        }
    }
}
