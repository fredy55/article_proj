<?php

namespace Database\Factories;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticlesFactory extends Factory
{
    protected $model = Articles::class;

    public function definition(): array
    {
    	return [
    	    'title' => $this->faker->name,
            'full_text' => $this->faker->text,
            'tag' => $this->faker->name
    	];
    }
}
