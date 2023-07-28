<?php

namespace App\Http\Controllers;
// app/Http/Controllers/ProductController.php

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
        // Get the sorting and filtering parameters from the request
        $sortBy = $request->input('sort', 'name'); // Default sorting by name
        $category = $request->input('category');

        // Fetch paginated products with sorting and filtering
        $products = $this->productService->getPaginatedProducts($sortBy, $category);
        $categories = $this->productService->getAllCategories();
        $products->appends(['category' => $category]);
        $products->appends(['sort' => $sortBy]);
        // dd($products);
        // Return the view with the paginated product list
        return view('pages.products.index', compact('products','categories'));
    }

    public function create()
    {
        // Fetch all categories to populate the category dropdown in the create form
        $categories = $this->productService->getAllCategories();

        // Return the view with the form to create a product
        return view('pages.products.create', compact('categories'));
    }

    public function edit($productId)
    {
        // Get the product details from the service based on the product ID
        $product = $this->productService->getProductById($productId);

        // Fetch all categories to populate the category dropdown in the edit form
        $categories = $this->productService->getAllCategories();

        // Pass the product and categories data to the view
        return view('pages.products.edit', compact('product', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming product data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'array', // Assuming categories are passed as an array of category IDs
        ]);

        // Handle image upload and get the image path
        $imagePath = $this->handleImageUpload($request->file('image'));

        // Create the product and attach categories
        $product = $this->productService->createProduct($validatedData, $imagePath);

        // Redirect to the product listing page with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function destroy($productId)
    {
        // Delete the product using the service
        $this->productService->deleteProduct($productId);

        // Redirect to the product listing page with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function update(Request $request, $productId)
    {
        // Validate the incoming product data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'array', // Assuming categories are passed as an array of category IDs
        ]);

        // Check if a new image was uploaded, and handle image upload if applicable
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->handleImageUpload($request->file('image'));
        }

        // Update the product using the service
        $this->productService->updateProduct($productId, $validatedData);

        // Redirect to the product listing page with a success message
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
