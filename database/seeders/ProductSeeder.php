<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'image' => 'products/apple.jpg',
            'name' => 'Apple',
            'kilo' => 1,
            'price' => 80,
        ]);

        Product::create([
            'image' => 'products/banana.jpg',
            'name' => 'Banana',
            'kilo' => 1,
            'price' => 60,
        ]);

        Product::create([
            'image' => 'products/orange.jpg',
            'name' => 'Orange',
            'kilo' => 1,
            'price' => 50,
        ]);

        Product::create([
            'image' => 'products/mango.jpg',
            'name' => 'Mango',
            'kilo' => 1,
            'price' => 100,
        ]);

        Product::create([
            'image' => 'products/strawberry.jpg',
            'name' => 'Strawberry',
            'kilo' => 1,
            'price' => 120,
        ]);
    }
}
