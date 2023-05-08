<?php

namespace Masmaleki\LaravelProductFinder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Masmaleki\LaravelProductFinder\Models\PFStep;

class PFStepFactory extends Factory
{
    protected $model = PFStep::class;

    public function definition()
    {
        return [
            'pf_wizard_id' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence(),
            'order' => $this->faker->randomNumber(),
            'desc' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
