<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fruits', 'sort_order' => 1],
            ['name' => 'Vegetables', 'sort_order' => 2],
            ['name' => 'Meat', 'sort_order' => 3],
            ['name' => 'Fish', 'sort_order' => 4],
            ['name' => 'Sea food', 'sort_order' => 5],
            ['name' => 'Juice', 'sort_order' => 6],
            ['name' => 'Egg & Milk', 'sort_order' => 7],
            ['name' => 'Ice cream', 'sort_order' => 8],
            ['name' => 'Cake', 'sort_order' => 9],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
