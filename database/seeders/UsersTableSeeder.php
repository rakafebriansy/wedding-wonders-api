<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'dev akses',
            'email' => 'devakses@gmail.com',
            'password' => Hash::make('password123'), 
        ]);

        DB::table('users')->insert([
            'username' => 'raka febrian',
            'email' => 'rakafebrian@gmail.com',
            'password' => Hash::make('password456'), 
        ]);
    }
}
