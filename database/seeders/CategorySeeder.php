<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'nama' => 'Makanan',
            'deskripsi' => 'Kategori makanan',
        ]);

        Category::create([
            'nama' => 'Minuman',
            'deskripsi' => 'Kategori minuman',
        ]);

        Category::create([
            'nama' => 'Rokok',
            'deskripsi' => 'Kategori rokok',
        ]);

        Category::create([
            'nama' => 'Sembako',
            'deskripsi' => 'Kategori sembako',
        ]);
    }
}