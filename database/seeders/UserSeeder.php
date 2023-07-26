<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name'    => 'Frendy',
            'last_name'     => 'Sanusi',
            'username'      => 'frenn',
            'email'         => 'frendy@labpro.itb.ac.id',
            'password'      => '$2y$10$JwJSy9v94twI9qfBG9O7dOfOXy17ZqLfWP7cH4OGSyOyWr/mZe8T6' // password
        ]);

        User::create([
            'first_name'    => 'Fawwaz Abrial',
            'last_name'     => 'Saffa',
            'username'      => 'abilll',
            'email'         => 'abil@labpro.itb.ac.id',
            'password'      => '$2y$10$JwJSy9v94twI9qfBG9O7dOfOXy17ZqLfWP7cH4OGSyOyWr/mZe8T6' // password
        ]);

        User::create([
            'first_name'    => 'Jonathan',
            'last_name'     => 'Sinaga',
            'username'      => 'jonnn',
            'email'         => 'jonnn@labpro.itb.ac.id',
            'password'      => '$2y$10$JwJSy9v94twI9qfBG9O7dOfOXy17ZqLfWP7cH4OGSyOyWr/mZe8T6' // password
        ]);
    }
}
