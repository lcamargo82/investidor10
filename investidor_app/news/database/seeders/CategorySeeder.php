<?php

namespace database\seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory()->count(5)->create();
    }
}
