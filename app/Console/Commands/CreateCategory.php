<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CreateCategory extends Command
{
    protected $signature = 'category:create 
                            {name : The name of the category}
                            {--parent= : The name of the parent category (optional)}';
    protected $description = 'Create a new category';

    public function handle()
    {
        $name = $this->argument('name');
        $parent_id = $this->option('parent');

        // Check if the parent category 
        if ($parent_id) {
            $parentCategory = Category::findOrFail($parent_id);

            // Check if the parent category exists
            if (!$parentCategory) {
                $this->error("Parent category '$parent_id' does not exist.");
                return;
            }

            // Create a new category with name and parent
            $category = Category::create([
                'name' => $name,
                'parent_id' => $parentCategory->id,
            ]);
        } else {
            // Create a new category with name only 
            $category = Category::create(['name' => $name]);
        }

        // Output success message
        $this->info("Category '$name' created successfully.");

        // If the category has a parent
        if ($parent_id) {
            $this->info("Parent Category: $parent_id");
        }
    }
}
