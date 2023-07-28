<?php

namespace App\Interfaces;
// app/Interfaces/ProductServiceInterface.php

interface ProductServiceInterface
{
    public function getPaginatedProducts($sortBy, $category);
    public function createProduct(array $data, $imagePath);
    public function updateProduct($productId, array $data);
    public function deleteProduct($productId);
    public function getAllCategories();
    
    public function getProductById($productId);
}
