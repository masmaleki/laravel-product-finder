<?php

namespace Masmaleki\LaravelProductFinder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Masmaleki\LaravelProductFinder\Models\PFTag;

class ModelFactory extends Factory
{
    protected $model = PFTag::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'value' => $this->faker->word,
            'info' => $this->faker->sentence
        ];
    }
}