<?php

namespace Masmaleki\LaravelProductFinder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Masmaleki\LaravelProductFinder\Models\PFWizard;

class ModelFactory extends Factory
{
    protected $model = PFWizard::class;

    public function definition()
    {
        // Create an empty array to hold the options
        $option = [];
  
        // Randomly select an input type
        $type = $this->faker->randomElement(['check_box', 'radio', 'range']);

        // Populate the options array based on the selected input type
        switch ($type) {
            case 'check_box':
                $option[$type] = [
                    'max_user_select' => $this->faker->numberBetween(1, 5),
                    'total_item' => $this->faker->numberBetween(1, 10),
                ];
                break;
            case 'radio':
                $option[$type] = [
                    'total_item' => $this->faker->numberBetween(1, 10),
                ];
                break;
            case 'range':
                $option[$type] = [
                    'max' => $this->faker->numberBetween(1, 100),
                    'min' => $this->faker->numberBetween(0, 50),
                    'step' => $this->faker->numberBetween(1, 10),
                    'unit' => $this->faker->word,
                    'def_value' => $this->faker->numberBetween(0, 50),
                ];
                break;
        }

        // Return the model definition with the generated data
        return [
            'pf_type_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word,
            // Encode the options array as JSON and save it to the option field
            'option' => json_encode($option),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
