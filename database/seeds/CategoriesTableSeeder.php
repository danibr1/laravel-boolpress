<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['HTML','CSS','Javascript','PHP'];
        foreach ($categories as $category) {
            // 1   Istanza
            $new_category = new Category();

            // 2 Popolate
            $new_category->name = $category;
            $new_category->slug= Str::slug($category, '-');

            // 3 Save
            $new_category->save();
        }
    }
}
