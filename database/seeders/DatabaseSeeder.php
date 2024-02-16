<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'Eliezer Rubio',
            'email'             => 'eliezer.rubio90@gmail.com',
            'password'          => Hash::make('12345678'),
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        \App\Models\User::factory(10)->create();
    }
}
