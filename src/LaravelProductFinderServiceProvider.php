<?php

namespace Masmaleki\LaravelProductFinder;

use Masmaleki\LaravelProductFinder\Commands\LaravelProductFinderCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelProductFinderServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('productfinder')
            ->hasConfigFile()
            ->hasViews('productfinder')
            ->hasMigrations([
                'create_pf_tags_table',
                'create_pf_products_table',
                'create_pf_product_tags_table',
                'create_pf_wizards_table',
                'create_pf_types_table',
                'create_pf_type_options_table',
                'create_pf_steps_table',
                'create_pf_questions_table',
                'create_pf_question_options_table',
                'create_pf_forms_table',
                'create_pf_answers_table',
            ])
            ->hasAssets()
            ->hasRoute('web')
            // ->runsMigrations()
            // ->hasCommand(LaravelProductFinderCommand::class)
            // ->hasInstallCommand(function (InstallCommand $command) {
            //     $command
            //         // ->startWith(function (InstallCommand $command) {
            //         //     $command->info('Hello, and welcome to my great new package!');
            //         // })
            //         ->publishConfigFile()
            //         ->publishAssets()
            //         ->publishMigrations()
            //         // ->copyAndRegisterServiceProviderInApp()
            //         // ->askToStarRepoOnGitHub()
            //         // ->endWith(function (InstallCommand $command) {
            //         //     $command->info('Have a great day!');
            //         // })
            //         ;
            // })
            ;
    }

    public function packageBooted()
    {

        if ($this->app->runningInConsole()) {
            $this->publishSeeders();
        }
    }

    protected function publishSeeders()
    {
        $this->publishes([
            __DIR__.'/../database/seeders/PFWizardSeeder.php' => database_path('seeders/PFWizardSeeder.php'),
            __DIR__.'/../database/seeders/PFStaticDataAISeeder.php' => database_path('seeders/PFStaticDataAISeeder.php'),
            __DIR__.'/../database/seeders/PFStaticTwoDataAISeeder.php' => database_path('seeders/PFStaticTwoDataAISeeder.php'),

        ], 'productfinder-seeders');
    }
}