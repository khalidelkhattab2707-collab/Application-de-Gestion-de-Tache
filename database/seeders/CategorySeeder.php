<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Travail',
            'Personnel',
            'Urgent',
            'Projet',
            'Réunion',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // 3 catégories aléatoires supplémentaires
        Category::factory(3)->create();
    }
}