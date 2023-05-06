<?php

namespace Masmaleki\LaravelProductFinder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Masmaleki\LaravelProductFinder\Models\PFProduct;

class ModelFactory extends Factory
{
    protected $model = PFProduct::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'picture' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'info' => $this->faker->paragraph,
        ];
    }
}

