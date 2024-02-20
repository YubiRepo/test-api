<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));
        $products = [];

        for ($i = 0; $i < 100; $i++) {
            if ($i % 2 == 1) {
                $foodName = $faker->foodName().' '.$faker->fruitName();
            } else {
                $foodName = $faker->meatName().' '.$faker->vegetableName();
            }

            $products[] = [
                'name' => $foodName,
                'unit_id' => $faker->randomElement([1,2,3,4]),
                'price' => random_int(500, 100_000),
                'stock' => random_int(0, 100),
                'description' => null,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Product::insert($products);
    }
}
