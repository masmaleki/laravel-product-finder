<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Masmaleki\LaravelProductFinder\Models\PFProduct;
use Masmaleki\LaravelProductFinder\Models\PFProductTag;
use Masmaleki\LaravelProductFinder\Models\PFQuestion;
use Masmaleki\LaravelProductFinder\Models\PFQuestionOption;
use Masmaleki\LaravelProductFinder\Models\PFStep;
use Masmaleki\LaravelProductFinder\Models\PFTag;
use Masmaleki\LaravelProductFinder\Models\PFType;
use Masmaleki\LaravelProductFinder\Models\PFTypeOption;
use Masmaleki\LaravelProductFinder\Models\PFWizard;

class PFStaticDataAISeeder extends Seeder
{
    const STATUS_ACTIVE = 'active';

    const TAG_LIMIT = 5;

    const TYPE_NAMES = ['checkbox', 'radio', 'range', 'input', 'upload'];

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

            $options = $this->getTypeOption($name);

            foreach ($options as $option) {

                PFTypeOption::create([
                    'name' => $option['name'],
                    'option' => json_encode($option['value']),
                    'status' => self::STATUS_ACTIVE,
                    'pf_type_id' => $type->id,
                ]);
            }

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
        for ($i = 1; $i <= 1; $i++) {
            $wizard = PFWizard::create([
                'title' => "Wizard $i",
                'desc' => "This is the description for Wizard $i",
                'status' => self::STATUS_ACTIVE,
            ]);

            for ($j = 1; $j <= 4; $j++) {
                $step = PFStep::create([
                    'pf_wizard_id' => $wizard->id,
                    'title' => "Step $j",
                    'order' => $j,
                    'desc' => "This is the description for Step $j of Wizard $i",
                    'status' => self::STATUS_ACTIVE,
                ]);
            }
            // Create question 1
            $question1 = PFQuestion::create([
                'pf_step_id' => 1,
                'pf_type_option_id' => 2,
                'title' => 'What is your age and gender?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => 'Please provide your age and gender.',
                'image' => '',
                'point' => 5,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 1 options
            PFQuestionOption::create([
                'pf_question_id' => $question1->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Under 30 and male',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question1->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Under 30 and female',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question1->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Over 30 and male',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question1->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Over 30 and female',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);

            // Create question 2
            $question2 = PFQuestion::create([
                'pf_step_id' => 1,
                'pf_type_option_id' => 2,
                'title' => 'When did you first notice your hair loss?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => 'Please describe when you first noticed your hair loss.',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 2 options
            PFQuestionOption::create([
                'pf_question_id' => $question2->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Within the last year',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question2->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => '1-3 years ago',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question2->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => '3-5 years ago',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question2->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Over 5 years ago',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);

            // Create question 3
            $question3 = PFQuestion::create([
                'pf_step_id' => 1,
                'pf_type_option_id' => 2,
                'title' => 'How quickly has your hair loss progressed?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => 'Please describe how quickly your hair loss has progressed.',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 3 options

            PFQuestionOption::create([
                'pf_question_id' => $question3->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Rapidly, within a few months',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question3->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Gradually, over several years',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question3->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'It has remained stable',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question3->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed

            ]);

            // Create question 4
            $question4 = PFQuestion::create([
                'pf_step_id' => 1,
                'pf_type_option_id' => 2,
                'title' => 'Have you experienced any sudden hair loss or shedding?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 4 options
            PFQuestionOption::create([
                'pf_question_id' => $question4->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes, within the last few months',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question4->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes, but it has since stopped',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question4->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No, my hair loss has been gradual',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question4->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 5
            $question5 = PFQuestion::create([
                'pf_step_id' => 2,
                'pf_type_option_id' => 2,
                'title' => 'Do you have any underlying medical conditions or are you taking any medications that may be contributing to your hair loss?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 5 options
            PFQuestionOption::create([
                'pf_question_id' => $question5->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question5->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question5->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question5->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Prefer not to answer',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 6
            $question6 = PFQuestion::create([
                'pf_step_id' => 2,
                'pf_type_option_id' => 2,
                'title' => 'How would you describe the pattern of your hair loss (e.g. receding hairline, thinning on top, etc.)?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 6 options
            PFQuestionOption::create([
                'pf_question_id' => $question6->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Receding hairline',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question6->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Thinning on top of the scalp',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question6->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Thinning all over the scalp',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question6->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 7
            $question7 = PFQuestion::create([
                'pf_step_id' => 2,
                'pf_type_option_id' => 2,
                'title' => 'Have you experienced any significant life changes or stressful events that may be related to your hair loss?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 7 options
            PFQuestionOption::create([
                'pf_question_id' => $question7->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question7->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question7->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question7->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Prefer not to answer',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 8
            $question8 = PFQuestion::create([
                'pf_step_id' => 3,
                'pf_type_option_id' => 2,
                'title' => 'Are there any areas of your scalp where you have noticed new hair growth or increased thickness?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 8 options
            PFQuestionOption::create([
                'pf_question_id' => $question8->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question8->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question8->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question8->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Prefer not to answer',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 9
            $question9 = PFQuestion::create([
                'pf_step_id' => 3,
                'pf_type_option_id' => 2,
                'title' => 'Are you interested in non-surgical hair restoration options, such as hair loss medications or hair growth supplements?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 9 options
            PFQuestionOption::create([
                'pf_question_id' => $question9->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question9->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question9->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question9->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Prefer not to answer',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 10
            $question10 = PFQuestion::create([
                'pf_step_id' => 3,
                'pf_type_option_id' => 2,
                'title' => 'Have you considered surgical hair restoration procedures, such as hair transplants or scalp reduction?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 10 options
            PFQuestionOption::create([
                'pf_question_id' => $question10->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question10->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question10->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question10->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Prefer not to answer',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 11
            $question11 = PFQuestion::create([
                'pf_step_id' => 3,
                'pf_type_option_id' => 2,
                'title' => 'What are your expectations for the outcome of any hair restoration procedures?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);

            // Create question 11 options
            PFQuestionOption::create([
                'pf_question_id' => $question11->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Significant improvement in hair density and thickness',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question11->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Some improvement, but not a complete restoration',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question11->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not sure',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question11->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Prefer not to answer',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 12
            $question12 = PFQuestion::create([
                'pf_step_id' => 3,
                'pf_type_option_id' => 2,
                'title' => 'Have you experienced any side effects or complications with any previous hair restoration procedures?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            // Create question 12 options
            PFQuestionOption::create([
                'pf_question_id' => $question12->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question12->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question12->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Not applicable, I have not had any previous hair restoration procedures',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question12->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Prefer not to answer',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 13
            $question13 = PFQuestion::create([
                'pf_step_id' => 3,
                'pf_type_option_id' => 2,
                'title' => 'What is your budget for hair restoration procedures?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            // Create question 13 options
            PFQuestionOption::create([
                'pf_question_id' => $question13->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Less than $5,000',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question13->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => '$5,000-$10,000',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question13->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => ' $10,000-$15,000',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question13->id,
                'pf_type_option_id' => 2,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'More than $15,000',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 14
            $question14 = PFQuestion::create([
                'pf_step_id' => 4,
                'pf_type_option_id' => 3,
                'title' => 'Did the transplant meet your expectations?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            // Create question 14 options
            PFQuestionOption::create([
                'pf_question_id' => $question14->id,
                'pf_type_option_id' => 3,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question14->id,
                'pf_type_option_id' => 3,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 15
            $question15 = PFQuestion::create([
                'pf_step_id' => 4,
                'pf_type_option_id' => 3,
                'title' => 'Did you experience any complications during or after the procedure?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question15->id,
                'pf_type_option_id' => 3,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question15->id,
                'pf_type_option_id' => 3,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 16
            $question16 = PFQuestion::create([
                'pf_step_id' => 4,
                'pf_type_option_id' => 6,
                'title' => 'If yes, please describe the complication',
                'conditions' => json_encode([
                    'and_conditions' => [15 => 1],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            // Create question 16 options
            PFQuestionOption::create([
                'pf_question_id' => $question16->id,
                'pf_type_option_id' => 6,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'describe the complication',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 17
            $question17 = PFQuestion::create([
                'pf_step_id' => 4,
                'pf_type_option_id' => 3,
                'title' => 'Were any medications prescribed after the procedure?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question17->id,
                'pf_type_option_id' => 3,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Yes',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question17->id,
                'pf_type_option_id' => 3,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'No',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 18
            $question18 = PFQuestion::create([
                'pf_step_id' => 4,
                'pf_type_option_id' => 6,
                'title' => 'If yes, please list the medication(s) prescribed',
                'conditions' => json_encode([
                    'and_conditions' => [17 => 1],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            // Create question 18 options
            PFQuestionOption::create([
                'pf_question_id' => $question18->id,
                'pf_type_option_id' => 6,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'please list the medication(s)',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 19
            $question19 = PFQuestion::create([
                'pf_step_id' => 4,
                'pf_type_option_id' => 7,
                'title' => 'How many days did it take you to recover from the procedure?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            // Create question 19 options
            PFQuestionOption::create([
                'pf_question_id' => $question19->id,
                'pf_type_option_id' => 7,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'How many days',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            // Create question 13
            $question20 = PFQuestion::create([
                'pf_step_id' => 4,
                'pf_type_option_id' => 1,
                'title' => 'What is your ?',
                'conditions' => json_encode([
                    'and_conditions' => [],
                    'or_conditions' => [],
                ]),
                'desc' => '',
                'image' => '',
                'point' => 10,
                'is_required' => true,
                'status' => self::STATUS_ACTIVE,
            ]);
            // Create question 20 options
            PFQuestionOption::create([
                'pf_question_id' => $question20->id,
                'pf_type_option_id' => 1,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Less than $5,000',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

            PFQuestionOption::create([
                'pf_question_id' => $question20->id,
                'pf_type_option_id' => 1,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Less than $5,000',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question20->id,
                'pf_type_option_id' => 1,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Less than $5,000',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);
            PFQuestionOption::create([
                'pf_question_id' => $question20->id,
                'pf_type_option_id' => 1,
                'pf_tag_id' => null,
                'value' => json_encode([
                    'title' => 'Less than $5,000',
                ]),
                'status' => self::STATUS_ACTIVE,
                'info' => null, // insert a description if needed
            ]);

        }
    }

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
                $response[] = [
                    'name' => 'checkbox_sample',
                    'value' => ['checkbox' => [
                        'max_user_select' => 2,
                        'total_item' => 4,
                    ]],
                ];

                return $response;
            case 'radio':
                $response[] = [
                    'name' => 'radio_sample',
                    'value' => ['radio' => [
                        'total_item' => 4,
                        'theme' => 'sample',
                    ]],
                ];
                $response[] = [
                    'name' => 'radio_btn',
                    'value' => ['radio' => [
                        'total_item' => 2,
                        'theme' => 'btn',
                    ]],
                ];

                return $response;

            case 'range':
                $response[] = [
                    'name' => 'range_sample',
                    'value' => ['range' => [
                        'max' => 15000,
                        'min' => 100,
                        'step' => 500,
                        'unit' => '$',
                        'def_value' => 1500,
                    ]],
                ];

                return $response;

            case 'input':
                $response[] = [
                    'name' => 'input_sample',
                    'value' => ['input' => [
                        'total_line' => 1,
                        'theme' => 'input',
                    ]],
                ];
                $response[] = [
                    'name' => 'input_textarea',
                    'value' => ['input' => [
                        'total_line' => 3,
                        'theme' => 'textarea',
                    ]],
                ];
                $response[] = [
                    'name' => 'input_price',
                    'value' => ['input' => [
                        'total_line' => 1,
                        'theme' => 'price',
                        'max' => 1000,
                        'min' => 1,
                        'step' => 10,
                        'def_value' => 1,
                    ]],
                ];

                return $response;

            default:
                return [];
        }
    }
}
