<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'title' => $this->faker->sentence(),
                'tags' => 'laravel, backend',
                'company' => $this->faker->company(),
                'location' => $this->faker->city(),
                'email' => $this->faker->companyEmail(),
                'website' => $this->faker->url(),
                'description' => $this->faker->paragraph(4),
        ];
    }
}
