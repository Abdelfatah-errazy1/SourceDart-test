<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CreateCategory extends Command
{
    // Get the category name from the command argument
    protected $signature = 'category:create {name}';
    protected $description = 'Create a new category';

    public function handle()
    {
        $name = $this->argument('name');
        // Create a new category with the provided name
        Category::create(['name' => $name]);
        // Output success message
        $this->info("Category '$name' created successfully.");
    }
}

