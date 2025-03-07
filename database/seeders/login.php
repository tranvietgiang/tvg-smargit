<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class login extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name' => 'tranvietgiang',
            'email' => 'tranvietgiang25@gmail.com',
            'password' => bcrypt('200225Tvg@')
        ]);
    }
}
