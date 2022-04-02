<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comments;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comments::factory()->times(2)->create();
    }
}
