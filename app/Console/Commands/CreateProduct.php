<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;

class CreateProduct extends Command
{
    protected $signature = 'product:create {name} {description} {price} {category_id}';
    protected $description = 'Create a new product';

    public function handle()
    {
        $name = $this->argument('name');
        $description = $this->argument('description');
        $price = $this->argument('price');
        $categoryId = $this->argument('category_id');

        $product = Product::create([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId,
        ]);

        $this->info("Product '$name' created successfully.");
    }
}
