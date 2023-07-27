<?php

// app/Services/ProductServiceImpl.php

namespace App\Services;

use App\Interfaces\ProductServiceInterface;
use App\Repositories\ProductRepositoryInterface;

class ProductServiceImpl implements ProductServiceInterface
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getPaginatedProducts($sortBy, $category)
    {
        return $this->productRepository->getPaginatedProducts($sortBy, $category);
    }

    public function createProduct(array $data, $imagePath)
    {
        // Implement the logic to create a product using the repository
        return $this->productRepository->createProduct($data, $imagePath);
    }

    public function updateProduct($productId, array $data)
    {
        // Implement the logic to update a product using the repository
        return $this->productRepository->updateProduct($productId, $data);
    }

    public function deleteProduct($productId)
    {
        // Implement the logic to delete a product using the repository
        return $this->productRepository->deleteProduct($productId);
    }
    public function getAllCategories()
    {
        return $this->productRepository->getAllCategories();
    }
    public function getProductById($productId)
    {
        return $this->productRepository->getProductById($productId);
    }
}
