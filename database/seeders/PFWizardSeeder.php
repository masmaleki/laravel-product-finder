<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Masmaleki\LaravelProductFinder\Models\PFOption;
use Masmaleki\LaravelProductFinder\Models\PFProduct;
use Masmaleki\LaravelProductFinder\Models\PFProductTag;
use Masmaleki\LaravelProductFinder\Models\PFQuestion;
use Masmaleki\LaravelProductFinder\Models\PFStep;
use Masmaleki\LaravelProductFinder\Models\PFTag;
use Masmaleki\LaravelProductFinder\Models\PFType;
use Masmaleki\LaravelProductFinder\Models\PFTypeOption;
use Masmaleki\LaravelProductFinder\Models\PFWizard;

class PFWizardSeeder extends Seeder
{
    const STATUS_ACTIVE = 'active';

    const TAG_LIMIT = 5;

    const TYPE_NAMES = ['checkbox', 'radio', 'range'];

    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Seed the database with PFType and PFTypeOption records.
     *
     * @return void
     */
    public function run()
    {
        $this->seedTypes();
        $this->seedWizards();
        $this->createProducts();
        $this->createTags();
        $this->associateTagsWithProducts();
    }

    /**
     * Seed the database with PFType and PFTypeOption records.
     *
     * @return void
     */
    protected function seedTypes()
    {
        foreach (self::TYPE_NAMES as $name) {
            $type = PFType::create([
                'name' => $name,
                'status' => self::STATUS_ACTIVE,
            ]);

            $option = $this->getTypeOption($name);

            PFTypeOption::create([
                'name' => $this->faker->word,
                'option' => json_encode($option),
                'status' => self::STATUS_ACTIVE,
                'pf_type_id' => $type->id,
            ]);
        }
    }

    /**
     * Seed the database with PFWizard, PFStep, and PFQuestion records.
     *
     * @return void
     */

    /**
     * Seed the database with PFWizard, PFStep, and PFQuestion records.
     *
     * @return void
     */
    protected function seedWizards()
    {
        for ($i = 1; $i <= 3; $i++) {
            $wizard = PFWizard::create([
                'title' => "Wizard $i",
                'desc' => "This is the description for Wizard $i",
                'status' => self::STATUS_ACTIVE,
            ]);

            for ($j = 1; $j <= 4; $j++) {
                $step = PFStep::create([
                    'pf_wizard_id' => $wizard->id,
                    'title' => "Step $j for Wizard $i",
                    'order' => $j,
                    'desc' => "This is the description for Step $j of Wizard $i",
                    'status' => self::STATUS_ACTIVE,
                ]);

                $questions = [];

                for ($k = 1; $k <= 5; $k++) {
                    $question = PFQuestion::create([
                        'pf_step_id' => $step->id,
                        'pf_type_option_id' => $this->faker->randomElement([1, 2, 3]),
                        'title' => "Question $k for Step $j of Wizard $i",
                        'conditions' => json_encode([
                            'and_conditions' => $this->faker->boolean() ? [
                                rand(1, 8) => rand(1, 3),
                                rand(1, 8) => rand(1, 3),
                            ] : [],
                            'or_conditions' => $this->faker->boolean() ? [
                                rand(1, 8) => rand(1, 3),
                                rand(1, 8) => rand(1, 3),
                            ] : [],
                        ]),
                        'desc' => "This is the description for Question $k of Step $j for Wizard $i",
                        'image' => 'https://example.com/image.jpg',
                        'point' => rand(0, 10),
                        'is_required' => $this->faker->boolean(),
                        'status' => self::STATUS_ACTIVE,
                    ]);

                    $questions[] = $question;
                }

                // Add random pf_option records for each question
                foreach ($questions as $question) {
                    // Get a random selection of type options to associate with the question
                    $typeOption = $question->typeOption;

                    $value = [];

                    switch ($typeOption->type->name) {
                        case 'checkbox':
                            $totalItems = rand(1, 10);
                            $maxUserSelect = rand(1, $totalItems);
                            //TODO::fix the signle option
                            for ($i = 1; $i <= $totalItems; $i++) {
                                $value[] = [
                                    'label' => $this->faker->word,
                                    'value' => $i,
                                ];
                            }

                            shuffle($value);

                            $value = [
                                'max_user_select' => $maxUserSelect,
                                'total_item' => $totalItems,
                                'items' => $value,
                            ];
                            break;
                        case 'radio':
                            $totalItems = rand(1, 10);

                            for ($i = 1; $i <= $totalItems; $i++) {
                                $value[] = [
                                    'label' => $this->faker->word,
                                    'value' => $i,
                                ];
                            }

                            shuffle($value);

                            $value = [
                                'total_item' => $totalItems,
                                'items' => $value,
                            ];
                            break;
                        case 'range':
                            $max = rand(1, 100);
                            $min = rand(0, 50);
                            $step = rand(1, 10);
                            $unit = $this->faker->word;
                            $defValue = rand($min, $max);

                            $value = [
                                'max' => $max,
                                'min' => $min,
                                'step' => $step,
                                'unit' => $unit,
                                'def_value' => $defValue,
                            ];

                            break;
                    }

                    // Get a random selection of tags to associate with the option
                    $tag = PFTag::inRandomOrder()->first();

                    $pfOption = new PFOption([
                        'pf_question_id' => $question->id,
                        'pf_type_option_id' => $typeOption->id,
                        'pf_tag_id' => $tag ? $tag->id : null,
                        'value' => json_encode($value),
                        'status' => self::STATUS_ACTIVE,
                    ]);

                    $pfOption->save();
                }
            }
        }
    }


    // protected function seedWizards()
    // {
    //     for ($i = 1; $i <= 3; $i++) {
    //         $wizard = PFWizard::create([
    //             'title' => "Wizard $i",
    //             'desc' => "This is the description for Wizard $i",
    //             'status' => self::STATUS_ACTIVE,
    //         ]);

    //         for ($j = 1; $j <= 4; $j++) {
    //             $step = PFStep::create([
    //                 'pf_wizard_id' => $wizard->id,
    //                 'title' => "Step $j for Wizard $i",
    //                 'order' => $j,
    //                 'desc' => "This is the description for Step $j of Wizard $i",
    //                 'status' => self::STATUS_ACTIVE,
    //             ]);

    //             for ($k = 1; $k <= 5; $k++) {
    //                 PFQuestion::create([
    //                     'pf_step_id' => $step->id,
    //                     'pf_type_option_id' => $this->faker->randomElement([1, 2, 3]),
    //                     'title' => "Question $k for Step $j of Wizard $i",
    //                     'conditions' => json_encode([
    //                         'and_conditions' => $this->faker->boolean() ? [
    //                             rand(1, 8) => rand(1, 3),
    //                             rand(1, 8) => rand(1, 3),
    //                         ] : [],
    //                         'or_conditions' => $this->faker->boolean() ? [
    //                             rand(1, 8) => rand(1, 3),
    //                             rand(1, 8) => rand(1, 3),
    //                         ] : [],
    //                     ]),
    //                     'desc' => "This is the description for Question $k of Step $j for Wizard $i",
    //                     'image' => 'https://example.com/image.jpg',
    //                     'point' => rand(0, 10),
    //                     'is_required' => $this->faker->boolean(),
    //                     'status' => self::STATUS_ACTIVE,
    //                 ]);
    //             }
    //         }
    //     }
    // }

    /**
     * Create sample PFProduct records.
     *
     * @return void
     */
    protected function createProducts()
    {
        // Create 50 products
        for ($i = 1; $i <= 50; $i++) {
            PFProduct::create([
                'name' => "Product $i",
                'picture' => "product-$i.jpg",
                'price' => rand(10, 100),
                'info' => "Info about product $i",
            ]);
        }
    }

    /**
     * Create sample PFTag records.
     *
     * @return void
     */
    protected function createTags()
    {
        // Create 80 tags
        for ($i = 1; $i <= 80; $i++) {
            PFTag::create([
                'name' => "Tag $i",
                'value' => "tag-$i",
                'info' => "Info about tag $i",
            ]);
        }
    }

    /**
     * Associate PFTag records with PFProduct records.
     *
     * @return void
     */
    protected function associateTagsWithProducts()
    {
        $products = PFProduct::all();
        $tags = PFTag::all();

        foreach ($products as $product) {
            // Get a random selection of tags to associate with the product
            $randomTags = $tags->random(self::TAG_LIMIT);

            foreach ($randomTags as $tag) {
                PFProductTag::create([
                    'pf_product_id' => $product->id,
                    'pf_tag_id' => $tag->id,
                ]);
            }
        }
    }

    /**
     * Get a type option array based on the given type name.
     *
     * @param  string  $type The type name
     * @return array The corresponding type option array
     */
    protected function getTypeOption(string $type): array
    {
        switch ($type) {
            case 'checkbox':
                return [
                    'checkbox' => [
                        'max_user_select' => $this->faker->numberBetween(1, 5),
                        'total_item' => $this->faker->numberBetween(1, 10),
                    ],
                ];
            case 'radio':
                return [
                    'radio' => [
                        'total_item' => $this->faker->numberBetween(1, 10),
                    ],
                ];
            case 'range':
                return [
                    'range' => [
                        'max' => $this->faker->numberBetween(1, 100),
                        'min' => $this->faker->numberBetween(0, 50),
                        'step' => $this->faker->numberBetween(1, 10),
                        'unit' => $this->faker->word,
                        'def_value' => $this->faker->numberBetween(0, 50),
                    ],
                ];
            default:
                return [];
        }
    }
}