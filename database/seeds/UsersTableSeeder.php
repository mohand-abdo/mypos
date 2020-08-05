<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('123'),
            'status' => 0
        ]);

        $user->attachRole('Super_Admin');
    }
}
