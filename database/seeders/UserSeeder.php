<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     
    public function run(): void
    {
        //création de l'administrateur
        User::create([
            'pseudo' => 'administrateur',
            'image' => 'user1.jpg',
            'password' => Hash::make('Admin99@'),
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 2
        ]);

        // création d'un utilisateur de test
        User::create([
            'pseudo' => 'utilisateur',
            'image' => 'user1.jpg',
            'password' => Hash::make('Utili99@'),
            'email' => 'utili@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 1
        ]);

        // création de 8 users aléatoires
        User::factory(8)->create();

    }
}
