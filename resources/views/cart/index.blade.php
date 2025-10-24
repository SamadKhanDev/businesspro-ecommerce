@extends('layouts.app')

@section('title', 'Shopping Cart - TechStore')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1>Shopping Cart</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(count($cart) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item['image'] }}" 
                                                 alt="{{ $item['name'] }}" 
                                                 style="width: 60px; height: 60px; object-fit: cover;" 
                                                 class="me-3">
                                            <div>
                                                <h6 class="mb-0">{{ $item['name'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" 
                                                   value="{{ $item['quantity'] }}" 
                                                   min="1" class="form-control form-control-sm" 
                                                   style="width: 80px;">
                                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                        ← Continue Shopping
                    </a>
                    <div>
                        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger me-2">
                                Clear Cart
                            </button>
                        </form>
                        <button class="btn btn-success" onclick="alert('Checkout functionality would be implemented here!')">
                            🛒 Proceed to Checkout
                        </button>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <h4>Your cart is empty</h4>
                    <p>Browse our products and add some items to your cart!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection