<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::factory()->count(5)->create();
        Product::factory()
        ->count(20)
        ->create()
        ->each(function ($product) {
            // Get all category IDs
            $categoryIds = Category::pluck('id');

            // Limit the number of categories to be attached
            $randomCategoryIds = $categoryIds->random(3);

            // Attach the categories to the product in the pivot table
            $product->categories()->attach($randomCategoryIds);
        });


    }
}
