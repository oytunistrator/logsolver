<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mopas.com.tr',
            'password' => bcrypt('*z2UnTH)Q.kn'),
        ]);
    }
}
