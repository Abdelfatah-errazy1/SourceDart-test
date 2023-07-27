<?php 
// app/Repositories/EloquentProductRepository.php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function getPaginatedProducts($sortBy, $category)
    {
        // Implement the logic to fetch paginated products with sorting and filtering
        // based on $sortBy and $category using Eloquent queries
    }

    public function createProduct(array $data, $imagePath)
    {
        // Implement the logic to create a product in the database using Eloquent
        $product = new Product($data);
        $product->image = $imagePath;
        $product->save();

        // Return the newly created product
        return $product;
    }

    public function updateProduct($productId, array $data)
    {
        // Implement the logic to update a product in the database using Eloquent
        $product = Product::findOrFail($productId);
        $product->update($data);

        // Return the updated product
        return $product;
    }

    public function deleteProduct($productId)
    {
        // Implement the logic to delete a product from the database using Eloquent
        $product = Product::findOrFail($productId);
        $product->delete();

        // Return true if the product was deleted successfully
        return true;
    }
    public function getAllCategories()
    {
        // Implement the logic to fetch all categories using Eloquent
        return Category::all();
    }
    public function getProductById($productId)
    {
        // Implement the logic to retrieve a product by its ID using Eloquent
        return Product::findOrFail($productId);
    }
}
