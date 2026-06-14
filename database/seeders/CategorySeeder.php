<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Pelatihan'],
            ['name' => 'Meeting'],
            ['name' => 'Workshop'],
            ['name' => 'Kunjungan'],
        ]);
    }
}