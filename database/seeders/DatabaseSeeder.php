<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\History;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::created([
        //     'name' => 'Irfan Afifi',
        //     'email' => 'apipiirpan@gmail.com',
        //     'password' => 'ponorogo',
        // ]);
        Category::create([
            'name' => 'Tas',
        ]);
        Category::create([
            'name' => 'ATK',
        ]);
        Category::create([
            'name' => 'Bahan Kue',
        ]);
        Item::create([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Tas Souvenir',
            'stock' => 20,
            'code_product' => 983628364,
            'description' => 'Tas souvenir berbagai warna',
            'basic_price' => 4000,
            'selling_price' => 5000,
        ]);
        Item::create([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Tas Sekolah',
            'stock' => 20,
            'code_product' => 983628364,
            'description' => 'Tas Sekolah berbagai warna',
            'basic_price' => 65000,
            'selling_price' => 80000,
        ]);
        Item::create([
            'user_id' => 1,
            'category_id' => 2,
            'name' => 'Polpen Pilot',
            'stock' => 20,
            'code_product' => 983628364,
            'description' => 'Polpen Pilot',
            'basic_price' => 4000,
            'selling_price' => 5000,
        ]);
        Item::create([
            'user_id' => 1,
            'category_id' => 2,
            'name' => 'Spidol black',
            'stock' => 20,
            'code_product' => 983628364,
            'description' => 'Spidol non-permanent',
            'basic_price' => 7000,
            'selling_price' => 9500,
        ]);
        Item::create([
            'user_id' => 1,
            'category_id' => 3,
            'name' => 'Backing soda',
            'stock' => 20,
            'code_product' => 983628364,
            'description' => 'Backing Soda',
            'basic_price' => 12000,
            'selling_price' => 15000,
        ]);
        Item::create([
            'user_id' => 1,
            'category_id' => 3,
            'name' => 'Backing soda',
            'stock' => 20,
            'code_product' => 983628364,
            'description' => 'Backing Soda',
            'basic_price' => 12000,
            'selling_price' => 15000,
        ]);
        // Order::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}