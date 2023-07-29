<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<section style="background-color: #eee;">
<div class="container py-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="https://www.sourcedart.org/">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
    </ol>
  </nav>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4 h1">Add New Product</h1>
            
            <!-- Product Create Form -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3 col-12">
                  <div class="d-flex justify-content-center align-items-center mb-4">
                    <label for="image" >
                      <img class="rounded  border border-transparent  cursor-pointer" width="200" height="140" id="imageProduct" src="{{ asset('assets/imgs/img1.jpg') }}" alt="image">
                    </label>
                  </div>
                  <input type="file" hidden name="image" id="image" value="{{ old('image') }}" class="border border-gray-400 p-2 rounded-lg hover:ring focus:outline-none w-100">
                  <x-error-message field="image" />
                </div>
                

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    <x-error-message field="name" />r
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                    <x-error-message field="price" />
                  </div>
              
                <div class="form-group">
                    <label for="categories">Categories</label>
                    <select name="categories[]" id="categories" class="form-control" multiple required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-error-message field="categories" />
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                    <x-error-message field="description" />
                  </div>
                
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
</section>
<script>
  var image=document.getElementById('image')
  console.log(image);
  var imageProduct=document.getElementById('imageProduct')
  image.onchange=()=>{
    const file = image.files[0];
    imageProduct.src = URL.createObjectURL(file);
  }
</script>
@endsection

