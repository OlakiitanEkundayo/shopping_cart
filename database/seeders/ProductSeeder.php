<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'MacBook Pro 14" (M3, 2023)',
            'description' => 'High-performance Apple laptop with M3 chip, 16GB RAM, and 512GB SSD.',
            'price' => 2200,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 10
        ]);

        Product::create([
            'name' => 'Dell XPS 13 Plus',
            'description' => 'Ultra-portable Windows laptop with Intel i7, 16GB RAM, and 1TB SSD.',
            'price' => 1800,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 11
        ]);

        Product::create([
            'name' => 'HP Spectre x360',
            'description' => 'Convertible touchscreen laptop with Intel i5, 8GB RAM, and 512GB SSD.',
            'price' => 1400,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 10
        ]);

        Product::create([
            'name' => 'iPhone 15 Pro',
            'description' => 'Apple’s flagship smartphone with A17 Pro chip and advanced camera system.',
            'price' => 1200,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 20
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S23 Ultra',
            'description' => 'High-end Android phone with 200MP camera and S Pen support.',
            'price' => 1100,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 9
        ]);

        Product::create([
            'name' => 'Google Pixel 8 Pro',
            'description' => 'Google’s premium phone with AI-powered features and top-notch cameras.',
            'price' => 1000,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 8
        ]);

        Product::create([
            'name' => 'Sony WH-1000XM5 Headphones',
            'description' => 'Noise-canceling wireless headphones with excellent sound quality.',
            'price' => 500,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 10
        ]);

        Product::create([
            'name' => 'LG OLED C3 55-inch TV',
            'description' => 'K OLED smart TV with Dolby Vision and stunning picture quality.',
            'price' => 1500,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 12
        ]);

        Product::create([
            'name' => 'Canon EOS R7 Camera',
            'description' => 'Mirrorless camera with 32MP APS-C sensor, great for photography and video.',
            'price' => 1800,
            'image' => 'placeholder.jpg',
            'stock_quantity' => 16
        ]);
    }
}
