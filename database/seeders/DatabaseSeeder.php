<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'  => 'Admin User',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'admin',
        ]);
        // $this->call([
        //     UserSeeder::class,
        //     // tambahkan disini jika ada seeder yang lainnya.
        // ]);
    }
}
