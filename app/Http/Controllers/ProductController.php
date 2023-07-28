<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProductServiceInterface;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
       
        // Get the sorting and filtering 
        $sortBy = $request->input('sort', 'name'); 
        $category = $request->input('category');

        // Fetch paginated products with sorting and filtering
        $products = $this->productService->getPaginatedProducts($sortBy, $category);
        $categories = $this->productService->getAllCategories();
        $products->appends(['category' => $category]);
        $products->appends(['sort' => $sortBy]);

        // Return the view with the paginated product list
        return view('pages.products.index', compact('products','categories'));
    }

    public function create()
    {
        $categories = $this->productService->getAllCategories();
        return view('pages.products.create', compact('categories'));
    }

    public function edit($productId)
    {
        $product = $this->productService->getProductById($productId);
        $categories = $this->productService->getAllCategories();
        return view('pages.products.edit', compact('product', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate  data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle image path
        $imagePath = $this->handleImageUpload($request->file('image'));

        // Create the product and attach categories
        $product = $this->productService->createProduct($validatedData, $imagePath);

        // Redirect to the product listing 
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function destroy($productId)
    {
        // Delete the product 
        $this->productService->deleteProduct($productId);

        // Redirect to the product listing 
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function update(Request $request, $productId)
    {
        // Validate  data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'array', 
        ]);

        // Check if a new image was uploaded,
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->handleImageUpload($request->file('image'));
        }

        // Update the product using the service
        $this->productService->updateProduct($productId, $validatedData);

        // Redirect to the product listing 
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

 


    private function handleImageUpload($imageFile)
    {
        // Ensure the uploaded file is valid
        if (!$imageFile->isValid()) {
            throw new \Exception('Invalid image file');
        }

        $imageDirectory = 'public/images/products';

        $imageName = time() . '_' . $imageFile->getClientOriginalName();

        $imagePath = $imageFile->storeAs($imageDirectory, $imageName);

        $publicImagePath = Storage::url($imagePath);

        return $publicImagePath;
    }
}
