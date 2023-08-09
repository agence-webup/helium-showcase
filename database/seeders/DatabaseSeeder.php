<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $products = \App\Models\Product::factory(500)->create();

        //Use loop bescause we can't use factory(number) with a random hasAttached() number
        for ($i = 0; $i < 200; $i++) {
            \App\Models\Category::factory()
                ->hasAttached(
                    $products->random(rand(0, 10)),
                    function ($category) {
                        return ['position' => $category->products()->count() + 1];
                    }
                )->create();
        }

    }
}
