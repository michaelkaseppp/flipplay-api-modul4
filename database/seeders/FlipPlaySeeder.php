<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FlipPlaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Michael Izzy',
            'email' => 'michael@flipplay.test',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Alip Member',
            'email' => 'alip@flipplay.test',
            'password' => Hash::make('password123'),
        ]);

        Media::create([
            'title' => 'Detective Conan',
            'type' => 'anime',
            'genre' => 'Mystery, Shounen',
            'release_year' => 1996,
            'description' => 'Detektif SMA Shinichi Kudo yang tubuhnya mengecil akibat racun organisasi hitam.',
        ]);

        Media::create([
            'title' => 'The K2',
            'type' => 'drama',
            'genre' => 'Action, Thriller',
            'release_year' => 2016,
            'description' => 'Mantan tentara bayaran yang menjadi pengawal pribadi putri kandidat presiden.',
        ]);
    }
}
