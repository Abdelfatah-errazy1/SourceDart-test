<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('products.index') }}">
      <img src="{{ asset('assets/imgs/logo.png') }}" width="80" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" href="{{ route('products.index') }}">Products</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('products.create') }}">Add Product</a>
          </li>
      </ul>
  </div>
</nav>