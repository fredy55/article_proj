<?php

namespace Database\Factories;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    protected $model = Comments::class;

    public function definition(): array
    {
    	return [
    	    'article_id' => rand(0, 9999),
    	    'subject' => $this->faker->name,
            'body' => $this->faker->text,
    	];
    }
}
