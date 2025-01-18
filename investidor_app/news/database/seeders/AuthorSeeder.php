<?php

namespace database\seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::factory()->count(10)->create();
    }
}
