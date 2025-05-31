<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use TomatoPHP\FilamentEcommerce\Models\Company;
use TomatoPHP\FilamentEcommerce\Models\Product;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting comprehensive ecommerce seeding...');

        // Create missing tables if they don't exist
        $this->createMissingTables();

        // Seed countries
        $this->seedCountries();

        // Seed categories
        $this->seedCategories();

        // Seed companies
        $this->seedCompanies();

        // Seed products
        $this->seedProducts();

        $this->command->info('✅ Comprehensive ecommerce data created successfully!');
    }

    /**
     * Create missing tables that are referenced but don't exist
     */
    private function createMissingTables(): void
    {
        $this->command->info('📋 Creating missing tables...');

        // Create countries table if it doesn't exist
        if (! Schema::hasTable('countries')) {
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
        if (! Schema::hasTable('categories')) {
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
     * Seed countries data
     */
    private function seedCountries(): void
    {
        $this->command->info('🌍 Seeding countries...');

        $countries = [
            ['name' => 'United States', 'code' => 'US', 'phone' => '+1', 'currency' => 'USD'],
            ['name' => 'United Kingdom', 'code' => 'GB', 'phone' => '+44', 'currency' => 'GBP'],
            ['name' => 'Canada', 'code' => 'CA', 'phone' => '+1', 'currency' => 'CAD'],
            ['name' => 'Australia', 'code' => 'AU', 'phone' => '+61', 'currency' => 'AUD'],
            ['name' => 'Germany', 'code' => 'DE', 'phone' => '+49', 'currency' => 'EUR'],
            ['name' => 'France', 'code' => 'FR', 'phone' => '+33', 'currency' => 'EUR'],
            ['name' => 'Japan', 'code' => 'JP', 'phone' => '+81', 'currency' => 'JPY'],
            ['name' => 'China', 'code' => 'CN', 'phone' => '+86', 'currency' => 'CNY'],
            ['name' => 'India', 'code' => 'IN', 'phone' => '+91', 'currency' => 'INR'],
            ['name' => 'Brazil', 'code' => 'BR', 'phone' => '+55', 'currency' => 'BRL'],
            ['name' => 'Mexico', 'code' => 'MX', 'phone' => '+52', 'currency' => 'MXN'],
            ['name' => 'Spain', 'code' => 'ES', 'phone' => '+34', 'currency' => 'EUR'],
            ['name' => 'Italy', 'code' => 'IT', 'phone' => '+39', 'currency' => 'EUR'],
            ['name' => 'Netherlands', 'code' => 'NL', 'phone' => '+31', 'currency' => 'EUR'],
            ['name' => 'Sweden', 'code' => 'SE', 'phone' => '+46', 'currency' => 'SEK'],
        ];

        foreach ($countries as $country) {
            DB::table('countries')->updateOrInsert(
                ['code' => $country['code']],
                array_merge($country, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('✅ Countries seeded successfully');
    }

    /**
     * Seed categories data
     */
    private function seedCategories(): void
    {
        $this->command->info('📂 Seeding categories...');

        $categories = [
            // Main Categories
            ['name' => json_encode(['en' => 'Electronics']), 'slug' => 'electronics', 'description' => json_encode(['en' => 'Latest electronic devices and gadgets']), 'icon' => 'heroicon-o-device-phone-mobile', 'color' => '#3B82F6', 'is_active' => true],
            ['name' => json_encode(['en' => 'Fashion & Clothing']), 'slug' => 'fashion-clothing', 'description' => json_encode(['en' => 'Trendy fashion and clothing items']), 'icon' => 'heroicon-o-sparkles', 'color' => '#EC4899', 'is_active' => true],
            ['name' => json_encode(['en' => 'Home & Garden']), 'slug' => 'home-garden', 'description' => json_encode(['en' => 'Everything for your home and garden']), 'icon' => 'heroicon-o-home', 'color' => '#10B981', 'is_active' => true],
            ['name' => json_encode(['en' => 'Sports & Fitness']), 'slug' => 'sports-fitness', 'description' => json_encode(['en' => 'Sports equipment and fitness gear']), 'icon' => 'heroicon-o-trophy', 'color' => '#F59E0B', 'is_active' => true],
            ['name' => json_encode(['en' => 'Books & Media']), 'slug' => 'books-media', 'description' => json_encode(['en' => 'Books, movies, music and more']), 'icon' => 'heroicon-o-book-open', 'color' => '#8B5CF6', 'is_active' => true],
            ['name' => json_encode(['en' => 'Health & Beauty']), 'slug' => 'health-beauty', 'description' => json_encode(['en' => 'Health and beauty products']), 'icon' => 'heroicon-o-heart', 'color' => '#EF4444', 'is_active' => true],
            ['name' => json_encode(['en' => 'Food & Beverages']), 'slug' => 'food-beverages', 'description' => json_encode(['en' => 'Gourmet food and beverages']), 'icon' => 'heroicon-o-cake', 'color' => '#F97316', 'is_active' => true],
            ['name' => json_encode(['en' => 'Automotive']), 'slug' => 'automotive', 'description' => json_encode(['en' => 'Car accessories and automotive parts']), 'icon' => 'heroicon-o-truck', 'color' => '#6B7280', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            $categoryId = DB::table('categories')->updateOrInsert(
                ['slug' => $category['slug']],
                array_merge($category, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // Add subcategories
        $this->seedSubcategories();

        $this->command->info('✅ Categories seeded successfully');
    }

    /**
     * Seed subcategories
     */
    private function seedSubcategories(): void
    {
        $subcategories = [
            // Electronics subcategories
            ['name' => 'Smartphones', 'slug' => 'smartphones', 'parent_slug' => 'electronics', 'description' => 'Latest smartphones and mobile devices'],
            ['name' => 'Laptops & Computers', 'slug' => 'laptops-computers', 'parent_slug' => 'electronics', 'description' => 'Laptops, desktops and computer accessories'],
            ['name' => 'Audio & Headphones', 'slug' => 'audio-headphones', 'parent_slug' => 'electronics', 'description' => 'Headphones, speakers and audio equipment'],
            ['name' => 'Smart Home', 'slug' => 'smart-home', 'parent_slug' => 'electronics', 'description' => 'Smart home devices and automation'],

            // Fashion subcategories
            ['name' => 'Men\'s Clothing', 'slug' => 'mens-clothing', 'parent_slug' => 'fashion-clothing', 'description' => 'Men\'s fashion and clothing'],
            ['name' => 'Women\'s Clothing', 'slug' => 'womens-clothing', 'parent_slug' => 'fashion-clothing', 'description' => 'Women\'s fashion and clothing'],
            ['name' => 'Shoes & Footwear', 'slug' => 'shoes-footwear', 'parent_slug' => 'fashion-clothing', 'description' => 'Shoes and footwear for all occasions'],
            ['name' => 'Accessories', 'slug' => 'accessories', 'parent_slug' => 'fashion-clothing', 'description' => 'Fashion accessories and jewelry'],

            // Home & Garden subcategories
            ['name' => 'Furniture', 'slug' => 'furniture', 'parent_slug' => 'home-garden', 'description' => 'Home and office furniture'],
            ['name' => 'Kitchen & Dining', 'slug' => 'kitchen-dining', 'parent_slug' => 'home-garden', 'description' => 'Kitchen appliances and dining essentials'],
            ['name' => 'Garden & Outdoor', 'slug' => 'garden-outdoor', 'parent_slug' => 'home-garden', 'description' => 'Garden tools and outdoor equipment'],
            ['name' => 'Home Decor', 'slug' => 'home-decor', 'parent_slug' => 'home-garden', 'description' => 'Decorative items and home accessories'],
        ];

        foreach ($subcategories as $subcategory) {
            $parentCategory = DB::table('categories')->where('slug', $subcategory['parent_slug'])->first();
            if ($parentCategory) {
                DB::table('categories')->updateOrInsert(
                    ['slug' => $subcategory['slug']],
                    [
                        'name' => json_encode(['en' => $subcategory['name']]),
                        'slug' => $subcategory['slug'],
                        'description' => json_encode(['en' => $subcategory['description']]),
                        'parent_id' => $parentCategory->id,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }

    /**
     * Seed companies data
     */
    private function seedCompanies(): void
    {
        $this->command->info('🏢 Seeding companies...');

        // Get a random country for companies
        $usCountry = DB::table('countries')->where('code', 'US')->first();
        $ukCountry = DB::table('countries')->where('code', 'GB')->first();
        $caCountry = DB::table('countries')->where('code', 'CA')->first();

        $companies = [
            [
                'name' => 'EcomStore Premium',
                'ceo' => 'John Smith',
                'email' => 'contact@ecomstore.com',
                'phone' => '+1-555-123-4567',
                'address' => '123 Commerce Street',
                'city' => 'New York',
                'zip' => '10001',
                'country_id' => $usCountry?->id,
                'registration_number' => 'REG-2024-001',
                'tax_number' => 'TAX-US-123456789',
                'website' => 'https://ecomstore.com',
                'notes' => 'Premium ecommerce company specializing in high-quality products and exceptional customer service.',
            ],
            [
                'name' => 'TechGear Solutions',
                'ceo' => 'Sarah Johnson',
                'email' => 'info@techgear.com',
                'phone' => '+1-555-987-6543',
                'address' => '456 Technology Ave',
                'city' => 'San Francisco',
                'zip' => '94102',
                'country_id' => $usCountry?->id,
                'registration_number' => 'REG-2024-002',
                'tax_number' => 'TAX-US-987654321',
                'website' => 'https://techgear.com',
                'notes' => 'Leading technology retailer with cutting-edge electronics and gadgets.',
            ],
            [
                'name' => 'Fashion Forward Ltd',
                'ceo' => 'Emma Wilson',
                'email' => 'hello@fashionforward.co.uk',
                'phone' => '+44-20-7123-4567',
                'address' => '789 Oxford Street',
                'city' => 'London',
                'zip' => 'W1C 1JN',
                'country_id' => $ukCountry?->id,
                'registration_number' => 'REG-UK-2024-003',
                'tax_number' => 'VAT-GB-123456789',
                'website' => 'https://fashionforward.co.uk',
                'notes' => 'Trendy fashion retailer offering the latest styles and designer collections.',
            ],
            [
                'name' => 'Home & Garden Co',
                'ceo' => 'Michael Brown',
                'email' => 'support@homeandgarden.ca',
                'phone' => '+1-416-555-0123',
                'address' => '321 Garden Way',
                'city' => 'Toronto',
                'zip' => 'M5V 3A8',
                'country_id' => $caCountry?->id,
                'registration_number' => 'REG-CA-2024-004',
                'tax_number' => 'GST-CA-987654321',
                'website' => 'https://homeandgarden.ca',
                'notes' => 'Complete home and garden solutions with premium furniture and outdoor equipment.',
            ],
        ];

        foreach ($companies as $companyData) {
            Company::updateOrCreate(
                ['email' => $companyData['email']],
                array_merge($companyData, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('✅ Companies seeded successfully');
    }

    /**
     * Seed products data
     */
    private function seedProducts(): void
    {
        $this->command->info('📦 Seeding products...');

        // Clear existing products first
        Product::truncate();

        // Get categories for assignment
        $electronicsCategory = DB::table('categories')->where('slug', 'electronics')->first();
        $smartphonesCategory = DB::table('categories')->where('slug', 'smartphones')->first();
        $audioCategory = DB::table('categories')->where('slug', 'audio-headphones')->first();
        $laptopsCategory = DB::table('categories')->where('slug', 'laptops-computers')->first();
        $fashionCategory = DB::table('categories')->where('slug', 'fashion-clothing')->first();
        $homeCategory = DB::table('categories')->where('slug', 'home-garden')->first();
        $sportsCategory = DB::table('categories')->where('slug', 'sports-fitness')->first();
        $booksCategory = DB::table('categories')->where('slug', 'books-media')->first();
        $healthCategory = DB::table('categories')->where('slug', 'health-beauty')->first();
        $foodCategory = DB::table('categories')->where('slug', 'food-beverages')->first();

        $products = [
            // Electronics - Smartphones
            [
                'category_id' => $smartphonesCategory?->id ?? $electronicsCategory?->id,
                'name' => ['en' => 'iPhone 15 Pro Max'],
                'slug' => 'iphone-15-pro-max',
                'about' => ['en' => 'Latest iPhone with titanium design and advanced camera system'],
                'description' => ['en' => 'Experience the most advanced iPhone ever with the iPhone 15 Pro Max. Featuring a stunning titanium design, the most powerful A17 Pro chip, and a revolutionary camera system that captures incredible detail. With up to 29 hours of video playback and advanced computational photography.'],
                'keywords' => ['en' => 'iPhone, smartphone, Apple, titanium, camera, A17 Pro'],
                'price' => 1199.99,
                'discount' => 100.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'is_trend' => true,
                'type' => 'product',
                'sku' => 'IPHONE-15-PM-001',
                'barcode' => '1234567890001',
                'has_unlimited_stock' => false,
                'min_cart' => 1,
                'max_cart' => 3,
            ],
            [
                'category_id' => $smartphonesCategory?->id ?? $electronicsCategory?->id,
                'name' => ['en' => 'Samsung Galaxy S24 Ultra'],
                'slug' => 'samsung-galaxy-s24-ultra',
                'about' => ['en' => 'Premium Android smartphone with S Pen and AI features'],
                'description' => ['en' => 'The Samsung Galaxy S24 Ultra redefines what a smartphone can do. With built-in S Pen, advanced AI features, and a stunning 200MP camera system. Features a 6.8-inch Dynamic AMOLED display and all-day battery life.'],
                'keywords' => ['en' => 'Samsung, Galaxy, Android, S Pen, AI, camera'],
                'price' => 1299.99,
                'discount' => 150.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'is_trend' => true,
                'type' => 'product',
                'sku' => 'GALAXY-S24-U-002',
                'barcode' => '1234567890002',
            ],

            // Electronics - Audio
            [
                'category_id' => $audioCategory?->id ?? $electronicsCategory?->id,
                'name' => ['en' => 'Sony WH-1000XM5 Wireless Headphones'],
                'slug' => 'sony-wh-1000xm5-wireless-headphones',
                'about' => ['en' => 'Industry-leading noise canceling wireless headphones'],
                'description' => ['en' => 'Experience exceptional sound quality with the Sony WH-1000XM5. Featuring industry-leading noise cancellation, 30-hour battery life, and crystal-clear call quality. Perfect for travel, work, or everyday listening.'],
                'keywords' => ['en' => 'Sony, headphones, wireless, noise canceling, audio'],
                'price' => 399.99,
                'discount' => 50.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'is_trend' => false,
                'type' => 'product',
                'sku' => 'SONY-WH1000XM5-003',
                'barcode' => '1234567890003',
            ],
            [
                'category_id' => $audioCategory?->id ?? $electronicsCategory?->id,
                'name' => ['en' => 'AirPods Pro (2nd Generation)'],
                'slug' => 'airpods-pro-2nd-generation',
                'about' => ['en' => 'Apple\'s premium wireless earbuds with adaptive transparency'],
                'description' => ['en' => 'AirPods Pro (2nd generation) deliver richer bass and clearer sound. With adaptive transparency, personalized spatial audio, and up to 6 hours of listening time. The MagSafe charging case provides multiple additional charges.'],
                'keywords' => ['en' => 'AirPods, Apple, wireless, earbuds, spatial audio'],
                'price' => 249.99,
                'discount' => 30.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'is_trend' => true,
                'type' => 'product',
                'sku' => 'AIRPODS-PRO-2-004',
                'barcode' => '1234567890004',
            ],

            // Electronics - Laptops
            [
                'category_id' => $laptopsCategory?->id ?? $electronicsCategory?->id,
                'name' => ['en' => 'MacBook Pro 16-inch M3 Max'],
                'slug' => 'macbook-pro-16-inch-m3-max',
                'about' => ['en' => 'Professional laptop with M3 Max chip for demanding workflows'],
                'description' => ['en' => 'The MacBook Pro 16-inch with M3 Max delivers exceptional performance for professionals. With up to 128GB unified memory, advanced GPU, and stunning Liquid Retina XDR display. Perfect for video editing, 3D rendering, and software development.'],
                'keywords' => ['en' => 'MacBook, Apple, M3 Max, professional, laptop'],
                'price' => 3999.99,
                'discount' => 200.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'is_trend' => false,
                'type' => 'product',
                'sku' => 'MBP-16-M3MAX-005',
                'barcode' => '1234567890005',
            ],
        ];

        // Seed first batch of products
        $this->seedProductBatch($products, 1);

        // Seed more product categories
        $this->seedFashionProducts();
        $this->seedHomeProducts();
        $this->seedSportsProducts();
        $this->seedBooksProducts();
        $this->seedHealthProducts();
        $this->seedFoodProducts();

        $this->command->info('✅ Products seeded successfully');
    }

    /**
     * Helper method to seed a batch of products
     */
    private function seedProductBatch(array $products, int $batchNumber): void
    {
        $this->command->info("📦 Seeding product batch {$batchNumber}...");

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                array_merge($productData, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }

    /**
     * Seed fashion products
     */
    private function seedFashionProducts(): void
    {
        $fashionCategory = DB::table('categories')->where('slug', 'fashion-clothing')->first();
        $mensCategory = DB::table('categories')->where('slug', 'mens-clothing')->first();
        $womensCategory = DB::table('categories')->where('slug', 'womens-clothing')->first();

        $fashionProducts = [
            [
                'category_id' => $mensCategory?->id ?? $fashionCategory?->id,
                'name' => ['en' => 'Premium Cotton T-Shirt'],
                'slug' => 'premium-cotton-t-shirt',
                'about' => ['en' => 'Comfortable premium cotton t-shirt for everyday wear'],
                'description' => ['en' => 'Made from 100% organic cotton, this premium t-shirt offers exceptional comfort and durability. Features a classic fit and comes in multiple colors. Perfect for casual wear or layering.'],
                'keywords' => ['en' => 'cotton, t-shirt, mens, organic, comfortable'],
                'price' => 29.99,
                'discount' => 5.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'type' => 'product',
                'sku' => 'COTTON-TSHIRT-006',
                'barcode' => '1234567890006',
            ],
            [
                'category_id' => $womensCategory?->id ?? $fashionCategory?->id,
                'name' => ['en' => 'Designer Silk Dress'],
                'slug' => 'designer-silk-dress',
                'about' => ['en' => 'Elegant silk dress perfect for special occasions'],
                'description' => ['en' => 'This stunning silk dress features a timeless design with modern touches. Made from premium silk fabric with a flattering silhouette. Perfect for formal events, dinner parties, or special occasions.'],
                'keywords' => ['en' => 'silk, dress, womens, designer, elegant'],
                'price' => 199.99,
                'discount' => 40.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'is_trend' => true,
                'type' => 'product',
                'sku' => 'SILK-DRESS-007',
                'barcode' => '1234567890007',
            ],
        ];

        $this->seedProductBatch($fashionProducts, 2);
    }

    /**
     * Seed home products
     */
    private function seedHomeProducts(): void
    {
        $homeCategory = DB::table('categories')->where('slug', 'home-garden')->first();
        $furnitureCategory = DB::table('categories')->where('slug', 'furniture')->first();
        $kitchenCategory = DB::table('categories')->where('slug', 'kitchen-dining')->first();

        $homeProducts = [
            [
                'category_id' => $furnitureCategory?->id ?? $homeCategory?->id,
                'name' => ['en' => 'Modern Office Chair'],
                'slug' => 'modern-office-chair',
                'about' => ['en' => 'Ergonomic office chair with lumbar support'],
                'description' => ['en' => 'This modern office chair combines style and comfort with ergonomic design. Features adjustable height, lumbar support, and breathable mesh back. Perfect for long work sessions and home offices.'],
                'keywords' => ['en' => 'office chair, ergonomic, furniture, modern'],
                'price' => 299.99,
                'discount' => 50.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'type' => 'product',
                'sku' => 'OFFICE-CHAIR-008',
                'barcode' => '1234567890008',
            ],
            [
                'category_id' => $kitchenCategory?->id ?? $homeCategory?->id,
                'name' => ['en' => 'Professional Chef Knife Set'],
                'slug' => 'professional-chef-knife-set',
                'about' => ['en' => 'High-quality stainless steel knife set for professional cooking'],
                'description' => ['en' => 'This professional-grade knife set includes 8 essential knives made from high-carbon stainless steel. Features ergonomic handles and comes with a beautiful wooden block. Perfect for home chefs and cooking enthusiasts.'],
                'keywords' => ['en' => 'knife set, chef, kitchen, stainless steel'],
                'price' => 149.99,
                'discount' => 25.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'type' => 'product',
                'sku' => 'KNIFE-SET-009',
                'barcode' => '1234567890009',
            ],
        ];

        $this->seedProductBatch($homeProducts, 3);
    }

    /**
     * Seed sports products
     */
    private function seedSportsProducts(): void
    {
        $sportsCategory = DB::table('categories')->where('slug', 'sports-fitness')->first();

        $sportsProducts = [
            [
                'category_id' => $sportsCategory?->id,
                'name' => ['en' => 'Professional Yoga Mat'],
                'slug' => 'professional-yoga-mat',
                'about' => ['en' => 'Non-slip yoga mat for all fitness levels'],
                'description' => ['en' => 'This premium yoga mat provides excellent grip and cushioning for all types of yoga practice. Made from eco-friendly materials with superior durability. Includes carrying strap and alignment guides.'],
                'keywords' => ['en' => 'yoga mat, fitness, exercise, non-slip'],
                'price' => 49.99,
                'discount' => 10.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'type' => 'product',
                'sku' => 'YOGA-MAT-010',
                'barcode' => '1234567890010',
            ],
        ];

        $this->seedProductBatch($sportsProducts, 4);
    }

    /**
     * Seed books products
     */
    private function seedBooksProducts(): void
    {
        $booksCategory = DB::table('categories')->where('slug', 'books-media')->first();

        $booksProducts = [
            [
                'category_id' => $booksCategory?->id,
                'name' => ['en' => 'The Art of Programming'],
                'slug' => 'the-art-of-programming',
                'about' => ['en' => 'Comprehensive guide to modern programming techniques'],
                'description' => ['en' => 'Master the fundamentals and advanced concepts of programming with this comprehensive guide. Covers multiple programming languages, best practices, and real-world examples. Perfect for beginners and experienced developers.'],
                'keywords' => ['en' => 'programming, book, coding, software development'],
                'price' => 39.99,
                'discount' => 5.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'type' => 'product',
                'sku' => 'BOOK-PROG-011',
                'barcode' => '1234567890011',
            ],
        ];

        $this->seedProductBatch($booksProducts, 5);
    }

    /**
     * Seed health products
     */
    private function seedHealthProducts(): void
    {
        $healthCategory = DB::table('categories')->where('slug', 'health-beauty')->first();

        $healthProducts = [
            [
                'category_id' => $healthCategory?->id,
                'name' => ['en' => 'Organic Face Moisturizer'],
                'slug' => 'organic-face-moisturizer',
                'about' => ['en' => 'Natural organic moisturizer for all skin types'],
                'description' => ['en' => 'This organic face moisturizer is formulated with natural ingredients to nourish and hydrate your skin. Suitable for all skin types, free from harmful chemicals, and cruelty-free. Leaves skin feeling soft and radiant.'],
                'keywords' => ['en' => 'moisturizer, organic, skincare, natural'],
                'price' => 24.99,
                'discount' => 3.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'type' => 'product',
                'sku' => 'MOISTURIZER-012',
                'barcode' => '1234567890012',
            ],
        ];

        $this->seedProductBatch($healthProducts, 6);
    }

    /**
     * Seed food products
     */
    private function seedFoodProducts(): void
    {
        $foodCategory = DB::table('categories')->where('slug', 'food-beverages')->first();

        $foodProducts = [
            [
                'category_id' => $foodCategory?->id,
                'name' => ['en' => 'Premium Organic Coffee Beans'],
                'slug' => 'premium-organic-coffee-beans',
                'about' => ['en' => 'Single-origin organic coffee beans from Colombia'],
                'description' => ['en' => 'Experience the rich, full-bodied flavor of these premium organic coffee beans sourced directly from Colombian farmers. Medium roast with notes of chocolate and caramel. Perfect for espresso, drip coffee, or French press.'],
                'keywords' => ['en' => 'coffee, organic, Colombian, premium, beans'],
                'price' => 19.99,
                'discount' => 2.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'is_trend' => true,
                'type' => 'product',
                'sku' => 'COFFEE-BEANS-013',
                'barcode' => '1234567890013',
            ],
            [
                'category_id' => $foodCategory?->id,
                'name' => ['en' => 'Artisan Honey Collection'],
                'slug' => 'artisan-honey-collection',
                'about' => ['en' => 'Premium honey collection from local beekeepers'],
                'description' => ['en' => 'This artisan honey collection features three unique varieties: wildflower, clover, and orange blossom. Each honey is raw, unfiltered, and sourced from local beekeepers. Perfect for cooking, baking, or enjoying on its own.'],
                'keywords' => ['en' => 'honey, artisan, raw, natural, collection'],
                'price' => 34.99,
                'discount' => 5.00,
                'vat' => 0.20,
                'is_activated' => true,
                'is_in_stock' => true,
                'is_shipped' => true,
                'type' => 'product',
                'sku' => 'HONEY-COLLECTION-014',
                'barcode' => '1234567890014',
            ],
        ];

        $this->seedProductBatch($foodProducts, 7);
    }
}
