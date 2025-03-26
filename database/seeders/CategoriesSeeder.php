<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::insert([
            ['category_name' => 'Snack'],
            ['category_name' => 'Side Dish'],
            ['category_name' => 'Main Course'],
            ['category_name' => 'Dessert'],
            ['category_name' => 'Drink'],
        ]);
    }
}
