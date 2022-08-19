<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text(fake()->numberBetween(10, 30)),
            'body' => fake()->text(fake()->numberBetween(100, 200)),
            'status' => 2
        ];
    }

    /**
     * Indicate that the post's status should be draft.
     *
     * @return static
     */
    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 1,
            ];
        });
    }

    /**
     * Indicate that the post's status should be published.
     *
     * @return static
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 2,
            ];
        });
    }

    /**
     * Indicate that the post's status should be unpublished.
     *
     * @return static
     */
    public function unpublished()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 3,
            ];
        });
    }
}
