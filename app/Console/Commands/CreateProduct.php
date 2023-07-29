<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateProduct extends Command
{
    protected $signature = 'product:create {name} {description} {price} 
                            {--category_ids=* : Comma-separated list of category IDs}
                            {--image= : Path to the image file}';
    protected $description = 'Create a new product';

    public function handle()
    {
        $name = $this->argument('name');
        $description = $this->argument('description');
        $price = $this->argument('price');
        $categoryIds = $this->option('category_ids');
        $imagePath = $this->option('image');

        // Validate that the image path is not empty
        if (empty($imagePath)) {
            $this->error("Please provide a valid image path using the --image option.");
            return;
        }

        // Convert the image path to an instance of UploadedFile
        $uploadedImage = new UploadedFile($imagePath, basename($imagePath));

        // Upload the image and get the URL
        $image = $this->uploadImage($uploadedImage);
      
        
        // Create the product
        $product = Product::create([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image,
        ]);

        // Attach categories to product
        $categories = Category::find($categoryIds);
        $product->categories()->attach($categories);

        //  success message
        $this->info("Product '$name' created successfully with categories: " . implode(', ', $categories->pluck('name')->toArray()));
    }

    private function uploadImage(UploadedFile $image)
    {
        // Generate a unique file name for the image
        $filename = md5(uniqid()) . '.' . $image->getClientOriginalExtension();

        // Move the  image to  storage 
        $imagePath = $image->storeAs('public/products', $filename);
        // Get the URL of image
        return Storage::url($imagePath);
    }
}
