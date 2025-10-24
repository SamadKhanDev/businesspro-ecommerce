@extends('layouts.app')

@section('title', 'Home - Sam Fusion')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Welcome to Sam Fusion</h1>
                <p class="lead mb-4">We provide high-quality products and exceptional services to meet all your business needs.</p>
                <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">Explore Products</a>
            </div>
           <div class="col-lg-6">
    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
         alt="Business Team Collaboration" class="img-fluid rounded shadow">
</div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2>Why Choose Us?</h2>
                <p class="lead">We stand out from the competition</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100 text-center">
                    <div class="card-body">
                        <div class="mb-3">
                            <span style="font-size: 3rem;">🚀</span>
                        </div>
                        <h5 class="card-title">Fast Delivery</h5>
                        <p class="card-text">Quick and reliable shipping to get your products when you need them.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100 text-center">
                    <div class="card-body">
                        <div class="mb-3">
                            <span style="font-size: 3rem;">⭐</span>
                        </div>
                        <h5 class="card-title">Quality Guarantee</h5>
                        <p class="card-text">All our products are thoroughly tested and quality assured.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100 text-center">
                    <div class="card-body">
                        <div class="mb-3">
                            <span style="font-size: 3rem;">💬</span>
                        </div>
                        <h5 class="card-title">24/7 Support</h5>
                        <p class="card-text">Our support team is always ready to help you with any questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


