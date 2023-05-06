<?php

namespace Masmaleki\LaravelProductFinder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Masmaleki\LaravelProductFinder\Models\PFWizard;

class PFWizadFactory extends Factory
{
    protected $model = PFWizard::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'desc' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}

