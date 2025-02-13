<?php

namespace Database\Seeders;

use App\Models\BookStatus;
use Illuminate\Database\Seeder;

class BookStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'Emprestado'],
            ['id' => 2, 'name' => 'Entregue'],
            ['id' => 3, 'name' => 'Atrasado']
        ];

        BookStatus::insert($data);
    }
}
