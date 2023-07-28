<?php 
// app/Repositories/EloquentProductRepository.php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function getPaginatedProducts($sortBy, $category)
    {
      $query = Product::query();

      // Sort products based on the provided column and direction
    //   dd($sortBy);
      if ($sortBy === 'name') {
          $query->orderBy('name');
      } elseif ($sortBy === 'price') {
          $query->orderBy('price');
      }

      // Filter products based on the selected category
      if ($category) {
          $query->whereHas('categories', function ($q) use ($category) {
              $q->where('id', $category);
            });
      }

      // Paginate the products with a fixed number of items per page
      $perPage = 6; 
      return $query->paginate($perPage);
  
    }

    public function createProduct(array $data, $imagePath)
    {
        // Implement the logic to create a product in the database using Eloquent
        $product = new Product($data);
        $product->image = $imagePath;
        $product->save();
        
        if (isset($data['categories'])) {
            $categories = Category::whereIn('id', $data['categories'])->get();
            $product->categories()->attach($categories);
        }
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
