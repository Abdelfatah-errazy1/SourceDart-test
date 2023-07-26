<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Product;

class DeleteProduct extends Command
{
    protected $signature = 'product:delete {id}';
    protected $description = 'Delete a product';

    public function handle()
    {
        $id = $this->argument('id');
        $product = Product::findOrFail($id);
        $product->delete();
        $this->info("Product '$product->name' deleted successfully.");
    }
}
