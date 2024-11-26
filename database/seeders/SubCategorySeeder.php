<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Replace these with actual category IDs in your database
        $categoryIds = \App\Models\Category::pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) { // Generating 20 subcategories
            $subCategory = new SubCategory();
            $subCategory->name = $faker->words(2, true); // Two random words
            $subCategory->slug = Str::slug($faker->unique()->words(3, true)); // Unique slug
            $subCategory->status = $faker->randomElement([0, 1]); // Random status
            $subCategory->showhome = $faker->randomElement(['Yes', 'No']);
            $subCategory->category_id = $faker->randomElement($categoryIds); // Random valid category ID
            $subCategory->save();

            // Add fake image
            $imageName = $subCategory->id . '.jpg'; // Example image extension
            $tempImagePath = public_path("tempImgs/fake_temp_image.jpg");
            $destinationPath = public_path("uploads/subcategory/$imageName");

            // Simulate moving a fake image for testing
            if (file_exists($tempImagePath)) {
                File::copy($tempImagePath, $destinationPath); // Copy fake image to destination
            }

            $subCategory->image = $imageName;
            $subCategory->save();
        }
    }
}
