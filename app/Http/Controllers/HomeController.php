<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $cartCount = count($cart);
        return view('home', compact('cartCount'));
    }
}