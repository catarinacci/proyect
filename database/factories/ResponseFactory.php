<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Response;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Response::class;

    public function definition()
    {
        return [
            'content' => $this->faker->text(),
            'comment_id' => Comment::all()->random()->id,
        ];
    }
}
