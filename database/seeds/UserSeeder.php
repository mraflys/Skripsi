<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator JKI',
            'email' => 'admin@tagana.com',
            'password' => bcrypt('12345678'),
            'username' => 'admin',
            'role' =>  'administrator'
        ]);
    }
}
