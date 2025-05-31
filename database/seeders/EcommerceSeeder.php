<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TomatoPHP\FilamentEcommerce\Models\Company;
use TomatoPHP\FilamentEcommerce\Models\Product;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default company
        $company = Company::create([
            'name' => 'Default Store',
            'email' => 'store@example.com',
            'phone' => '+1234567890',
            'address' => '123 Main Street',
            'city' => 'New York',
            'zip' => '10001',
            'country_id' => null, // No country for now
        ]);

        // Create some sample products
        $products = [
            [
                'name' => ['en' => 'Wireless Bluetooth Headphones'],
                'slug' => 'wireless-bluetooth-headphones',
                'about' => ['en' => 'High-quality wireless headphones with noise cancellation'],
                'description' => ['en' => 'Experience premium sound quality with these wireless Bluetooth headphones featuring active noise cancellation, 30-hour battery life, and comfortable over-ear design.'],
                'price' => 199.99,
                'discount' => 20.00,
                'is_activated' => true,
                'type' => 'product',
                'sku' => 'WBH-001',
                'barcode' => '1234567890123',
            ],
            [
                'name' => ['en' => 'Smart Fitness Watch'],
                'slug' => 'smart-fitness-watch',
                'about' => ['en' => 'Advanced fitness tracking with heart rate monitor'],
                'description' => ['en' => 'Stay connected and track your fitness goals with this smart watch featuring GPS, heart rate monitoring, sleep tracking, and 7-day battery life.'],
                'price' => 299.99,
                'discount' => 50.00,
                'is_activated' => true,
                'type' => 'product',
                'sku' => 'SFW-002',
                'barcode' => '1234567890124',
            ],
            [
                'name' => ['en' => 'Organic Coffee Beans'],
                'slug' => 'organic-coffee-beans',
                'about' => ['en' => 'Premium organic coffee beans from Colombia'],
                'description' => ['en' => 'Enjoy the rich, full-bodied flavor of these premium organic coffee beans sourced directly from Colombian farmers. Perfect for espresso or drip coffee.'],
                'price' => 24.99,
                'discount' => 0,
                'is_activated' => true,
                'type' => 'product',
                'sku' => 'OCB-003',
                'barcode' => '1234567890125',
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        $this->command->info('Sample ecommerce data created successfully!');
    }
}
