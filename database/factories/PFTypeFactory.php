<?php

namespace Masmaleki\LaravelProductFinder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Masmaleki\LaravelProductFinder\Models\PFType;

class ModelFactory extends Factory
{
    protected $model = PFType::class;

    public function definition()
    {
        $name = $this->faker->randomElement(['checkbox', 'radio', 'bar', 'uploads', 'textinput']);

        return [
            'name' => $name,
            'status' => 'active',
        ];
    }
}

