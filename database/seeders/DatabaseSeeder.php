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
        $productsNumber = 1000;
        $categoriesNumber = 200;
        $maxProductsPerCategory = 25;

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $products = \App\Models\Product::factory($productsNumber)->create();

        //Use loop bescause we can't use factory(number) with a random hasAttached() number
        for ($i = 0; $i < $categoriesNumber; $i++) {
            $nb = 0;
            \App\Models\Category::factory()
                ->hasAttached(
                    $products->random(rand(0, $maxProductsPerCategory)),
                    function ($category) use (&$nb) {
                        return ['position' => $nb++];
                    }
                )->create();
        }

    }
}
