<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Maak een standaard admin-gebruiker
        User::create([
            'username' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => bcrypt('Password!321'),
            'role' => 'admin', // Zorg ervoor dat je 'role' hebt toegevoegd aan je model en database
        ]);

        // Maak een paar testgebruikers aan
        User::factory(10)->create();

        // Optioneel: Specifieke testgebruikers met rollen
        User::create([
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user', // Specificeer rol
        ]);

        User::create([
            'username' => 'editor',
            'email' => 'editor@example.com',
            'password' => bcrypt('editor123'),
            'role' => 'admin', // Adminrol voor testen
        ]);
    }
}
