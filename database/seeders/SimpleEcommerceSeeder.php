<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use TomatoPHP\FilamentEcommerce\Models\Company;
use TomatoPHP\FilamentEcommerce\Models\Product;

class SimpleEcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting simple ecommerce seeding...');

        // Create missing tables if they don't exist
        $this->createMissingTables();

        // Seed basic data
        $this->seedBasicData();

        $this->command->info('✅ Simple ecommerce data created successfully!');
    }

    /**
     * Create missing tables that are referenced but don't exist
     */
    private function createMissingTables(): void
    {
        $this->command->info('📋 Creating missing tables...');

        // Create countries table if it doesn't exist
        if (!Schema::hasTable('countries')) {
            Schema::create('countries', function ($table) {
                $table->id();
                $table->string('name');
                $table->string('code', 3)->unique();
                $table->string('iso_code', 2)->unique();
                $table->string('phone_code')->nullable();
                $table->string('currency')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
            $this->command->info('✅ Countries table created');
        }

        // Create categories table if it doesn't exist
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function ($table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->string('icon')->nullable();
                $table->string('color')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->timestamps();
                
                $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
                $table->index(['is_active', 'sort_order']);
            });
            $this->command->info('✅ Categories table created');
        }
    }

    /**
     * Seed basic data
     */
    private function seedBasicData(): void
    {
        $this->command->info('📦 Seeding basic data...');

        // Add a few countries
        $countries = [
            ['name' => 'United States', 'code' => 'USA', 'iso_code' => 'US', 'phone_code' => '+1', 'currency' => 'USD'],
            ['name' => 'United Kingdom', 'code' => 'GBR', 'iso_code' => 'GB', 'phone_code' => '+44', 'currency' => 'GBP'],
            ['name' => 'Canada', 'code' => 'CAN', 'iso_code' => 'CA', 'phone_code' => '+1', 'currency' => 'CAD'],
        ];

        foreach ($countries as $country) {
            DB::table('countries')->updateOrInsert(
                ['iso_code' => $country['iso_code']],
                array_merge($country, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // Add basic categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Electronic devices and gadgets', 'sort_order' => 1],
            ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Fashion and clothing items', 'sort_order' => 2],
            ['name' => 'Home & Garden', 'slug' => 'home-garden', 'description' => 'Home and garden products', 'sort_order' => 3],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['slug' => $category['slug']],
                array_merge($category, [
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // Add a company
        $usCountry = DB::table('countries')->where('iso_code', 'US')->first();
        
        Company::updateOrCreate(
            ['email' => 'contact@ecomstore.com'],
            [
                'name' => 'EcomStore Premium',
                'ceo' => 'John Smith',
                'email' => 'contact@ecomstore.com',
                'phone' => '+1-555-123-4567',
                'address' => '123 Commerce Street',
                'city' => 'New York',
                'zip' => '10001',
                'country_id' => $usCountry?->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Add some products
        $electronicsCategory = DB::table('categories')->where('slug', 'electronics')->first();
        
        $products = [
            [
                'category_id' => $electronicsCategory?->id,
                'name' => ['en' => 'iPhone 15 Pro Max'],
                'slug' => 'iphone-15-pro-max',
                'about' => ['en' => 'Latest iPhone with titanium design'],
                'description' => ['en' => 'Experience the most advanced iPhone ever with the iPhone 15 Pro Max.'],
                'price' => 1199.99,
                'discount' => 100.00,
                'is_activated' => true,
                'is_in_stock' => true,
                'type' => 'product',
                'sku' => 'IPHONE-15-PM-001',
                'barcode' => '1234567890001',
            ],
            [
                'category_id' => $electronicsCategory?->id,
                'name' => ['en' => 'Samsung Galaxy S24 Ultra'],
                'slug' => 'samsung-galaxy-s24-ultra',
                'about' => ['en' => 'Premium Android smartphone'],
                'description' => ['en' => 'The Samsung Galaxy S24 Ultra redefines what a smartphone can do.'],
                'price' => 1299.99,
                'discount' => 150.00,
                'is_activated' => true,
                'is_in_stock' => true,
                'type' => 'product',
                'sku' => 'GALAXY-S24-U-002',
                'barcode' => '1234567890002',
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                array_merge($productData, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('✅ Basic data seeded successfully');
    }
}
