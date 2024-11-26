<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $product = Product::create([
                'title' => $faker->sentence(3),
                'slug' => $faker->unique()->slug,
                'short_description' => $faker->text(50),
                'description' => $faker->text(200),
                'shipping_returns' => $faker->text(100),
                'price' => $faker->randomFloat(2, 10, 1000),
                'compare_price' => $faker->randomFloat(2, 10, 1200),
                'section_id' => $faker->numberBetween(1, 3),
                'category_id' => $faker->numberBetween(1, 3),
                // 'sub_category_id' => $faker->numberBetween(1, 50),
                'brand_id' => $faker->numberBetween(1,4),
                'related_products' => implode(',', $faker->randomElements(range(1, 50), 5)),
                'is_featured' => $faker->randomElement(['Yes', 'No']),
                'sku' => $faker->unique()->bothify('SKU-####'),
                'barcode' => $faker->isbn13,
                'track_qty' => $faker->randomElement(['Yes', 'No']),
                'qty' => $faker->numberBetween(1, 100),
                'status' => $faker->boolean ? 1 : 0,
            ]);

            // Simulate adding images (Optional)
            // for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
            //     $product->images()->create([
            //         'image' => $faker->imageUrl(640, 480, 'products', true, 'Faker'),
            //     ]);
            // }
        }
    }
}
