<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class DeleteCategory extends Command
{
    protected $signature = 'category:delete {id}';
    protected $description = 'Delete a category';

    public function handle()
    {
        $id = $this->argument('id');
        $category = Category::findOrFail($id);
        $category->delete();
        $this->info("Category '$category->name' deleted successfully.");
    }
}
