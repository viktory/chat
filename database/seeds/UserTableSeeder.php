<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(['email' => 'admin@email.com', 'username' => 'Admin', 'password' => \Illuminate\Support\Facades\Hash::make('123123'), 'is_admin' => true]);
    }
}
