<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $cartCount = count($cart);
        return view('contact.index', compact('cartCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        return redirect()->route('contact.index')
                         ->with('success', 'Your message has been sent successfully! (Note: This is a demo - no actual database storage)');
    }
}