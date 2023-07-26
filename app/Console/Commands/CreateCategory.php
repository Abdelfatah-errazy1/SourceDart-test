<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CreateCategory extends Command
{
    protected $signature = 'category:create {name}';
    protected $description = 'Create a new category';

    public function handle()
    {
        $name = $this->argument('name');
        Category::create(['name' => $name]);
        $this->info("Category '$name' created successfully.");
    }
}

