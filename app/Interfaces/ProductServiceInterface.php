// app/Interfaces/ProductServiceInterface.php
<?php
namespace App\Interfaces;

interface ProductServiceInterface
{
    public function getPaginatedProducts($sortBy, $category);
    public function createProduct(array $data, $imagePath);
    public function updateProduct($productId, array $data);
    public function deleteProduct($productId);
    public function getAllCategories();
    
    public function getProductById($productId);
}
