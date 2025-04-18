<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Electronics', 'parent_id' => null],
            ['name' => 'Clothing', 'parent_id' => null],
            ['name' => 'Home & Garden', 'parent_id' => null],
            ['name' => 'Books', 'parent_id' => null],
            ['name' => 'Smartphones', 'parent_id' => 1],
            ['name' => 'Laptops', 'parent_id' => 1],
            ['name' => 'Men\'s Clothing', 'parent_id' => 2],
            ['name' => 'Women\'s Clothing', 'parent_id' => 2],
            ['name' => 'Furniture', 'parent_id' => 3],
            ['name' => 'Kitchen', 'parent_id' => 3],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
