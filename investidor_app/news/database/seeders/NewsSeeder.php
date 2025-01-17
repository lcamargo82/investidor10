<?php

namespace database\seeders;

use App\Models\News;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run()
    {
        News::factory()->count(30)->create();
    }
}
