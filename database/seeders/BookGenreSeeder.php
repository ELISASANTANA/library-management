<?php

namespace Database\Seeders;

use App\Models\BookGenre;
use Illuminate\Database\Seeder;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'Ficção Científica'],
            ['id' => 2, 'name' => 'Fantasia'],
            ['id' => 3, 'name' => 'Romance'],
            ['id' => 4, 'name' => 'Mistério'],
            ['id' => 5, 'name' => 'Thriller']
        ];

        BookGenre::insert($data);
    }
}
