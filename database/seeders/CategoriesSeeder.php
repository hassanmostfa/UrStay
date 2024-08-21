<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Category 1',
            'parent_id' => null,
            'slug' => 'category-3',
            'description' => 'Category 1 description' ,
            'image' => null ,
            'status' => 'active',
        ]);
    }
}
