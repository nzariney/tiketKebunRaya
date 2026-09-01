<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
        'name' => 'Admin Kebun Raya',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('12345678'),
        'role' => 'admin',
        ]);

        Ticket::create([
        'name' => 'Tiket Dewasa',
        'category' => 'Dewasa',
        'price' => 25000,
        ]);

        Ticket::create([
        'name' => 'Tiket Anak',
        'category' => 'Anak',
        'price' => 15000,
        ]);

        User::create([
        'name' => 'Pengunjung',
        'email' => 'user@gmail.com',
        'password' => Hash::make('12345678'),
        'role' => 'user',
        ]);
    }
}
