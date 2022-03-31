<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Articles;
use App\Models\Comments;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articles::factory()
                ->count(50)
                ->has(Comments::factory()->count(3))
                ->create();
    }
}
