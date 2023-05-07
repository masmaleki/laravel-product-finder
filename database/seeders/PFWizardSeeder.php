<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Masmaleki\LaravelProductFinder\Models\PFProduct;
use Masmaleki\LaravelProductFinder\Models\PFQuestion;
use Masmaleki\LaravelProductFinder\Models\PFStep;
use Masmaleki\LaravelProductFinder\Models\PFTag;
use Masmaleki\LaravelProductFinder\Models\PFType;
use Masmaleki\LaravelProductFinder\Models\PFTypeOption;
use Masmaleki\LaravelProductFinder\Models\PFWizard;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PFWizardSeeder extends Seeder
{
    public function run()
    {

        $faker = Faker::create();

       // Seed PFType and its related models
        $names = ['checkbox', 'radio', 'range'];
        for ($i = 0; $i <= 2; $i++) {
            $name = $names[$i];
            // Create new PFType instance
            $pfType = new PFType([
                'name' => $name,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $pfType->save();
            $option = $this->getTypeOption($name);
            // Create new PFTypeOption instance
            $pfTypeOption = new PFTypeOption([
                'name' => $faker->word,
                'option' => json_encode($option),
                'status' => 'active',
                'pf_type_id' => $pfType->id
             ]);

            // Save the PFTypeOption instance
            $pfTypeOption->save();             
        }

        // Seed PFWizard and its related models
        for ($i = 1; $i <= 8; $i++) {
            $pfWizards[$i] = PFWizard::create([
                'title' => 'Wizard '.$i,
                'desc' => 'Description for Wizard '.$i,
                'status' => rand(0, 1) ? 'active' : 'inactive',
            ]);
        }

    }
    /**
     * Get a random type name from the available options.
     *
     * @return string
     */
    private function getRandomTypeName()
    {
        // $names = ['checkbox', 'radio', 'bar', 'uploads', 'textinput'];
        $names = ['checkbox', 'radio', 'range'];

        $index = array_rand($names);
        return $names[$index];
    }
        /**
     * Get a random type option based on the selected input type.
     *
     * @return array
     */
    private function getTypeOption($type)
    {
        $faker = Faker::create();

        // Populate the options array based on the selected input type
        switch ($type) {
            case 'checkbox':
                return [
                    'checkbox' => [
                        'max_user_select' => $faker->numberBetween(1, 5),
                        'total_item' => $faker->numberBetween(1, 10),
                    ]
                ];
            case 'radio':
                return [
                    'radio' => [
                        'total_item' => $faker->numberBetween(1, 10),
                    ]
                ];
            case 'range':
                return [
                    'range' => [
                        'max' => $faker->numberBetween(1, 100),
                        'min' => $faker->numberBetween(0, 50),
                        'step' => $faker->numberBetween(1, 10),
                        'unit' => $faker->word,
                        'def_value' => $faker->numberBetween(0, 50),
                    ]
                ];
            default:
                return [];
        }
    }
    //     public function run()
    //     {
    //         // Seed PFType and its related models
    //         $pfTypes = PFType::factory()->count(10)->create();

    //         // For each PFType instance, create related PFTypeOption instances
    //         foreach ($pfTypes as $pfType) {
    //             PFTypeOption::factory()->count(5)->create([
    //                 'pf_type_id' => $pfType->id,
    //             ]);
    //         }

    //         // Seed PFWizard and its related models
    //         $pfWizards = PFWizard::factory()->count(10)->create();

    //         // For each PFWizard instance, create related PFStep instances
    //         foreach ($pfWizards as $pfWizard) {
    //             $pfSteps = PFStep::factory()->count(5)->create([
    //                 'pf_wizard_id' => $pfWizard->id,
    //             ]);

    //             // For each PFStep instance, create related PFQuestion instances
    //             foreach ($pfSteps as $pfStep) {
    //                 $pfQuestions = PFQuestion::factory()->count(3)->create([
    //                     'pf_step_id' => $pfStep->id,
    //                 ]);

    //                 // For each PFQuestion instance, create related PFTag instances
    //                 foreach ($pfQuestions as $pfQuestion) {
    //                     PFTag::factory()->count(3)->create([
    //                         'pf_question_id' => $pfQuestion->id,
    //                     ]);

    //                     // For each PFQuestion instance, create related PFTypeOption instances
    //                     $pfTypeOptions = $pfQuestion->pfType->pfTypeOptions;
    //                     foreach ($pfTypeOptions as $pfTypeOption) {
    //                         PFQuestion::factory()->count(3)->create([
    //                             'pf_question_id' => $pfQuestion->id,
    //                             'pf_type_option_id' => $pfTypeOption->id,
    //                         ]);
    //                     }
    //                 }
    //             }
    //         }
    //         // Create 50 PFProduct instances using the factory method
    //         $pfProducts = PFProduct::factory()->count(50)->create();

    //         // For each PFProduct instance, create related PFTag instances
    //         foreach ($pfProducts as $pfProduct) {
    //             $pfTags = PFTag::factory()->count(3)->create();

    //             // Attach the created tags to the product
    //             $pfProduct->tags()->attach($pfTags);
    //         }
    //     }
}
