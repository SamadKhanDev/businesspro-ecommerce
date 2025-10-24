<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Sample products
        Product::create([
            'name' => 'Premium Laptop',
            'description' => 'High-performance laptop with latest processor and ample storage.',
            'price' => 999.99,
            'image' => 'https://via.placeholder.com/300x200/3498db/ffffff?text=Premium+Laptop'
        ]);

        Product::create([
            'name' => 'Wireless Headphones',
            'description' => 'Noise-cancelling wireless headphones with superior sound quality.',
            'price' => 199.99,
            'image' => 'https://via.placeholder.com/300x200/e74c3c/ffffff?text=Wireless+Headphones'
        ]);

        Product::create([
            'name' => 'Smartphone Pro',
            'description' => 'Latest smartphone with advanced camera and long-lasting battery.',
            'price' => 799.99,
            'image' => 'https://via.placeholder.com/300x200/2c3e50/ffffff?text=Smartphone+Pro'
        ]);
    }
}