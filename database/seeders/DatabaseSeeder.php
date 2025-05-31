<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');

        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@ecomstore.com',
        ]);

        $this->command->info('✅ Admin user created');

        // Run comprehensive ecommerce seeding
        $this->call([
            EcommerceSeeder::class,
        ]);

        $this->command->info('🎉 Database seeding completed successfully!');
    }
}
