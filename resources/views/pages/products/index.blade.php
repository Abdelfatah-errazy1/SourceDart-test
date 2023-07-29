@extends('layouts.app')

@section('title', 'List of Products')

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
                    <div class="description">
                        @if (strlen($product->description) > 60)
                            <span class="truncated">
                                {{ substr($product->description, 0, 60) }}...
                            </span>
                            <span class="full" style="display: none;">
                                {{ $product->description }}
                            </span>
                            <a href="#" class="read-more">Read more</a>
                        @else
                            {{ $product->description }}
                        @endif
                    </div>
                    
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
            <ul class="pagination">
                <!-- Previous Page Link -->
                @if ($products->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif
        
                <!-- Current Page  Link -->
                <li class="page-item active">
                    <span class="page-link">{{ $products->currentPage() }}</span>
                </li>
        
                <!-- Next Page Link -->
                @if ($products->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
  </div>
</section>
@endsection