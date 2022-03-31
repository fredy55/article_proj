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
    	    'subject' => $this->faker->title,
            'body' => $this->faker->text,
    	];
    }
}
