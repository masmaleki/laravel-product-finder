<?php

namespace Masmaleki\LaravelProductFinder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Masmaleki\LaravelProductFinder\Models\PFQuestion;

class ModelFactory extends Factory
{
    protected $model = PFQuestion::class;

    public function definition()
    {
        // Define an array for storing the conditions for this question.
        // The 'is_required' key represents a nested array that stores the IDs
        // of the options that are required for each question. The keys of this
        // nested array represent the question IDs, and the values represent
        // the ID of the option that is required for that question.
        // sample conditions object[
        //     "and_conditions" => [
        //         3 => 6,
        //         8 => 19
        //     ]
        //     "or_conditions" => [
        //         3 => 6,
        //         8 => 19
        //     ]
        // ]
        
        $conditions = [
            "and_conditions" => [],
            "or_conditions" => []
        ];

        // Generate a random number of required options for this question.
        $requiredCount = $this->faker->numberBetween(0, 3);

        // Generate the required options randomly and store them in the conditions array.
        for ($i = 1; $i <= $requiredCount; $i++) {
            $optionId = $this->faker->numberBetween(1, 25);
            $questionId = $this->faker->numberBetween(1, 15);
            $conditions["and_conditions"][$questionId] = $optionId;
        }
       // Generate the required options randomly and store them in the conditions array.
        for ($i = 1; $i <= $requiredCount; $i++) {
            $optionId = $this->faker->numberBetween(1, 25);
            $questionId = $this->faker->numberBetween(1, 15);
            $conditions["or_conditions"][$questionId] = $optionId;
        }
        

        // Encode the conditions array as a JSON string and return it.
        $conditions = json_encode($conditions);

        return [
            'pf_step_id' => $this->faker->numberBetween(1, 10),
            'pf_type_option_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->sentence,
            'conditions' => $conditions,
            'desc' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'point' => rand(0, 10),
            'is_required' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
