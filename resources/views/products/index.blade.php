@extends('layouts.app')

@section('title', 'Products - TechStore')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col">
            <h1>Our Products</h1>
            <p class="lead">Discover our wide range of tech products</p>
        </div>
    </div>

    <!-- Success Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search and Add Product Bar -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form action="{{ route('products.search') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" 
                       placeholder="Search products..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-success">
                + Add New Product
            </a>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row">
        @if(count($products) > 0)
            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card product-card h-100">
                        <img src="{{ $product['image'] }}" 
                             class="card-img-top" alt="{{ $product['name'] }}" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text">{{ Str::limit($product['description'], 80) }}</p>
                            <p class="h5 text-primary mb-3">${{ number_format($product['price'], 2) }}</p>
                            
                            <!-- Add to Cart Button -->
                            <form action="{{ route('cart.add', $product['id']) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    🛒 Add to Cart
                                </button>
                            </form>
                            
                            <!-- Delete Button (Admin) -->
                            <form action="{{ route('products.destroy', $product['id']) }}" 
                                  method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info text-center">
                    @if(request()->has('search'))
                        No products found matching your search criteria.
                    @else
                        No products available. <a href="{{ route('products.create') }}">Add the first product!</a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection