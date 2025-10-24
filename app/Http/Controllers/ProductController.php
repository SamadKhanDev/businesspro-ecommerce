<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Static product data with reliable image URLs
    private $products = [
        [
            'id' => 1,
            'name' => 'Gaming Laptop Pro',
            'description' => 'High-performance gaming laptop with RTX 4070 and Intel i9 processor.',
            'price' => 1899.99,
            'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'
        ],
        [
            'id' => 2,
            'name' => 'Wireless Earbuds Pro',
            'description' => 'Noise-cancelling true wireless earbuds with 30hr battery life.',
            'price' => 199.99,
            'image' => 'https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'
        ],
        [
            'id' => 3,
            'name' => 'Smartphone Pro Max',
            'description' => 'Latest smartphone with triple camera system and 5G connectivity.',
            'price' => 1099.99,
            'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'
        ],
        [
            'id' => 4,
            'name' => 'Mechanical Keyboard',
            'description' => 'RGB mechanical keyboard with customizable switches and macro keys.',
            'price' => 149.99,
            'image' => 'https://images.unsplash.com/photo-1541140532154-b024d705b90a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'
        ],
        [
            'id' => 5,
            'name' => 'Gaming Headset',
            'description' => '7.1 surround sound gaming headset with noise cancellation.',
            'price' => 129.99,
            'image' => 'https://images.unsplash.com/photo-1599669454699-248893623440?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'
        ],
        [
            'id' => 6,
            'name' => 'Wireless Headphones',
            'description' => 'Premium over-ear wireless headphones with active noise cancellation.',
            'price' => 299.99,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'
        ]
    ];

    public function index()
    {
        $products = session('products', $this->products);
        $cart = session('cart', []);
        $cartCount = $this->getCartCount($cart);
        
        return view('products.index', compact('products', 'cartCount'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $allProducts = session('products', $this->products);
        $cart = session('cart', []);
        $cartCount = $this->getCartCount($cart);
        
        if ($search) {
            $products = array_filter($allProducts, function($product) use ($search) {
                return stripos($product['name'], $search) !== false || 
                       stripos($product['description'], $search) !== false;
            });
        } else {
            $products = $allProducts;
        }
        
        return view('products.index', compact('products', 'search', 'cartCount'));
    }

    public function create()
    {
        $cart = session('cart', []);
        $cartCount = $this->getCartCount($cart);
        return view('products.create', compact('cartCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|url'
        ]);

        $products = session('products', $this->products);
        
        $newProduct = [
            'id' => count($products) + 1,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image ?: 'https://images.unsplash.com/photo-1496171367470-9ed9a91ea931?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80'
        ];

        $products[] = $newProduct;
        session(['products' => $products]);

        return redirect()->route('products.index')
                         ->with('success', 'Product added successfully!');
    }

    public function destroy($id)
    {
        $products = session('products', $this->products);
        
        $products = array_filter($products, function($product) use ($id) {
            return $product['id'] != $id;
        });

        $products = array_values($products);
        session(['products' => $products]);

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully!');
    }

    // Cart functionality
    public function addToCart(Request $request, $id)
    {
        $products = session('products', $this->products);
        $cart = session('cart', []);
        
        $product = collect($products)->firstWhere('id', $id);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        // Check if product already in cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            if ($quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $quantity;
            }
            
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function viewCart()
    {
        $cart = session('cart', []);
        $cartCount = $this->getCartCount($cart);
        $total = $this->getCartTotal($cart);

        return view('cart.index', compact('cart', 'cartCount', 'total'));
    }

    public function clearCart()
    {
        session(['cart' => []]);
        return redirect()->route('cart.view')->with('success', 'Cart cleared!');
    }

    // Helper methods
    private function getCartCount($cart)
    {
        return array_sum(array_column($cart, 'quantity'));
    }

    private function getCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}