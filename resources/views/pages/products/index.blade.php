@extends('layouts.app')

@section('content')


<section style="background-color: #eee;">
  <div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://www.sourcedart.org/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
    <form action="{{ route('products.index') }}" method="GET" class="form-inline mb-3">
      <div class="form-group">
          <label for="category">Filter by Category:</label>
          <select name="category" id="category" class="form-control mr-2">
              <option value="">All Categories</option>
              @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                  </option>
              @endforeach
          </select>
      </div>
      <div class="form-group">
          <label for="sort">Sort By:</label>
          <select name="sort" id="sort" class="form-control ml-2">
              <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
              <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
          </select>
      </div>
      <button type="submit" class="btn btn-primary ml-2">Apply</button>
  </form>
    <div class="row justify-content-center">
        @foreach ($products as $product)       
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card text-black">
                <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                <img src="{{ asset($product->image) }}"
                    class="card-img-top" alt="{{ $product->name }}" style=" height: 170px;" />
                <div class="card-body">
                    <div class="text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="text-muted mb-4">{{ $product->description }}</p>
                    </div>

                    <div class="d-flex justify-content-between total font-weight-bold mt-4">
                    <span>Price</span><span>${{ $product->price }}</span>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center my-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <!-- Previous Page Link -->
                @if ($products->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                 <!-- Page Links (display only two pages) -->
                 @if ($products->lastPage() > 1)
                 @if ($products->currentPage() == 1)
                     <li class="page-item {{ $products->currentPage() == 1 ? 'active' : '' }}">
                         <a class="page-link" href="{{ $products->url(1) }}">1</a>
                     </li>
                     @if ($products->currentPage() + 1 <= $products->lastPage())
                         <li class="page-item">
                             <a class="page-link" href="{{ $products->url(2) }}">2</a>
                         </li>
                     @endif
                 @elseif ($products->currentPage() == $products->lastPage())
                     @if ($products->currentPage() - 1 >= 1)
                         <li class="page-item">
                             <a class="page-link" href="{{ $products->url($products->currentPage() - 1) }}">{{ $products->currentPage() - 1 }}</a>
                         </li>
                     @endif
                     <li class="page-item {{ $products->currentPage() == $products->lastPage() ? 'active' : '' }}">
                         <a class="page-link" href="{{ $products->url($products->currentPage()) }}">{{ $products->currentPage() }}</a>
                     </li>
                 @else
                     <li class="page-item {{ $products->currentPage() == $products->lastPage() - 1 ? 'active' : '' }}">
                         <a class="page-link" href="{{ $products->url($products->currentPage()) }}">{{ $products->currentPage() }}</a>
                     </li>
                     <li class="page-item {{ $products->currentPage() == $products->lastPage() ? 'active' : '' }}">
                         <a class="page-link" href="{{ $products->url($products->currentPage() + 1) }}">{{ $products->currentPage() + 1 }}</a>
                     </li>
                 @endif
             @endif

                <!-- Next Page Link -->
                @if ($products->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
  </div>
</section>
@endsection

<!-- resources/views/products/index.blade.php -->

{{-- 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Product Listing</h1>
            
            <!-- Filter and Sort Form -->
            <form action="{{ route('products.index') }}" method="GET" class="form-inline mb-3">
                <div class="form-group">
                    <label for="category">Filter by Category:</label>
                    <select name="category" id="category" class="form-control mr-2">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sort">Sort By:</label>
                    <select name="sort" id="sort" class="form-control ml-2">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary ml-2">Apply</button>
            </form>

            <!-- Product Listing Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Categories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100"></td>
                            <td>
                                @foreach($product->categories as $category)
                                    <span class="badge badge-info">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <!-- View Product button -->
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                <!-- Edit Product button -->
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <!-- Delete Product button with a form to perform a DELETE request -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination links -->
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection --}}
